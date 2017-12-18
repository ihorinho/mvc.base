<?php
namespace Controller;

use Library\Controller;
use Library\Request;
use Model\Forms\ContactForm;
use Model\Feedback;
use Gregwar\Captcha\CaptchaBuilder;

/**
 * Class SiteController
 * @package Controller
 */
class SiteController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function indexAction(Request $request)
    {
        return $this->render('index.phtml.twig');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function contactAction(Request $request)
    {
        $builder = new CaptchaBuilder;
        $builder->build();
        $session = $request->getSession();
        $phrase = $session->get('captcha');
        $session->set('captcha', $builder->getPhrase());
        $form = new ContactForm($request);
        $repo = $this->container->get('repository_manager')->getRepository('Feedback');
        if ($request->isPost()) {
            if ($form->isValid()) {
                if ($phrase == $form->getPhrase()) {
                    $feedback = (new Feedback())
                        ->setUsername($form->getUsername())
                        ->setEmail($form->getEmail())
                        ->setMessage($form->getMessage())
                        ->setIpAddress($request->getIpAddress());

                    $repo->save($feedback);
                    $session->setFlash('Feedback saved');
                    $this->redirect('contact-us');
                }
                $session->setFlash('Not correct phrase from picture');
                return $this->render('contacts.phtml.twig', ['form' => $form, 'phrase' => $phrase,'builder' => $builder]);
            }
            $session->setFlash('Fill the fields');
        }
        return $this->render('contacts.phtml.twig', ['form' => $form, 'builder' => $builder, 'phrase' => $phrase]);
    }
}