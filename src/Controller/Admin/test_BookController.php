<?php
namespace Controller\Admin;

use Library\Controller;
use Library\Pagination\Pagination;
use Library\Request;
use Model\Book;
use Model\Forms\BookAddForm;
use Model\Forms\BookEditForm;
use Model\UploadedFile;

class BookController extends Controller
{
    const BOOK_COVER_FILE = 'book_cover';

    public function indexAction(Request $request)
    {
        $this->isAdmin();
        $session = $request->getSession();
        $session->set('uri', $_SERVER['REQUEST_URI']);
        $repo = $this->container->get('repository_manager')->getRepository('Book');
        $booksCount = $repo->getCount(true);
        $currentPage = $request->get('page') > 1 ? $request->get('page') : 1;
        $pagination = new Pagination($currentPage, $booksCount, self::PER_PAGE);
        $offset = ($currentPage - 1) * self::PER_PAGE;
        $books = $repo->getAllActive($offset, self::PER_PAGE);
        if (!$books && $booksCount) {
            $this->redirect('/books/list/1');
        }
        $args = ['books'=>$books, 'pagination' => $pagination, 'page' => $currentPage];
        return $this->render('index.phtml.twig',$args);
    }

    public function editAction(Request $request)
    {
        $this->isAdmin();
        if (null === ($id = $request->get('id'))) {
            return 'Error! Book not found';
        }
        $session = $this->getSession();
        $repoBook = $this->container->get('repository_manager')->getRepository('Book');
        $book = $repoBook->getById($id);

        if ($request->isPost()) {
            $form = new BookEditForm($request);
            if ($form->isValid()) {
                $editedBook = (new Book())
                    ->setTitle($form->getTitle())
                    ->setDescription($form->getDescription())
                    ->setId($form->getId())
                    ->setPrice($form->getPrice())
                    ->setStyleId($form->getStyleId())
                    ->setAuthorIds($form->getAuthors())
                    ->setIsActive($form->getIsActive());
                $repoBook->updateBook($editedBook)
                    ->deleteBookAuthor($editedBook->getId())
                    ->insertBookAuthor($editedBook->getId(), $editedBook->getAuthorIds());
                $bookCover = new UploadedFile(self::BOOK_COVER_FILE);
                if ($bookCover->isJPG()) {
                    $bookCover->moveToUploads($form->getId());
                }
                $session->setFlash('Success');
                $this->saveLog('Book id: ' . $form->getId() .  ' changed', [$session->get('user')]);
                $this->redirect('/admin/books/list');
            }
            $session->setFlash('Fill the important fields');
        }

        $repoStyle = $this->container->get('repository_manager')->getRepository('Style');
        $styles = $repoStyle->getAll();
        $repoAuthor = $this->container->get('repository_manager')->getRepository('Author');
        $authors = $repoAuthor->getAllFullNames();

        $args = ['book' => $book, 'authors' => $authors, 'styles' => $styles];
        return $this->render('edit.phtml.twig', $args);
    }
}