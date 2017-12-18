<?php
namespace Controller\Admin;

use Library\Controller;
use Library\Request;
use Model\ContactForm;
use Model\Feedback;

/**
 * Class SiteController
 * @package Controller\Admin
 */
class SiteController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function indexAction(Request $request)
    {
        $this->isAdmin();
        return $this->render('index.phtml.twig');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function contactAction(Request $request)
    {
        $form = new ContactForm($request);
        $session = $this->getSession();
        $repo = $this->container->get('repository_manager')->getRepository('Feedback');
        if ($request->isPost()) {
            if ($form->isValid()) {
                $feedback = (new Feedback())
                    ->setUsername($form->getUsername())
                    ->setEmail($form->getEmail())
                    ->setMessage($form->getMessage())
                    ->setIpAddress($request->getIpAddress());

                $repo->save($feedback);
                $session->setFlash('Feedback saved');
                $this->saveLog('Feedback saved', [$form->getEmail()]);
                $this->redirect('contact-us');
            }
            $session->setFlash('Fill the fields');
        }
        return $this->render('contacts.phtml.twig', ['form' => $form]);
    }
}