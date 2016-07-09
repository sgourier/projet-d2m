<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 16/05/2016
 * Time: 16:54
 */

namespace VimoliaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class ContactusController extends Controller
{
    /**
     * @Route("/contactus", name="contactus")
     */
    public function displayContactusAction()
    {
        $form = $this->createContactForm();

        return $this->render('default/contactus/displayContactus.html.twig',array(
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/sendContact", name="send_contact")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function sendContactAction(Request $request)
    {
        $form = $this->createContactForm();
        $form->handleRequest($request);

        $session = $this->get('session');

        if($form->isValid())
        {
            $datas = $form->getData();
            $message = \Swift_Message::newInstance()
                                     ->setSubject($this->get('translator')->trans($datas['subject']))
                                     ->setFrom(array($this->getParameter('mailer_user')),$this->getParameter('mailer_name'))
                                     ->setTo($this->getParameter('mailer_user'))
                                     ->setBody(
                                         $this->renderView(
                                             'default/mails/contact.html.twig',
                                             array(
                                                 'subject' => $datas['subject'],
                                                 'name' => $datas['name'],
                                                 'email' => $datas['email'],
                                                 'message' => $datas['message'],
                                             )
                                         ),
                                         'text/html'
                                     );

            try
            {
                if($this->get('mailer')->send($message))
                {
                    $session->getFlashBag()->add('notice', 'contactUs.mailSended');
                }
                else
                {
                    $session->getFlashBag()->add('error', 'contactUs.mailError');
                }

            }
            catch (\Swift_TransportException $e)
            {
                $session->getFlashBag()->add('error', 'contactUs.mailError');
            }

        }
        else
        {
            $session->getFlashBag()->add('error', 'contactUs.mailError');
        }

        return $this->redirectToRoute('contactus');
    }

    /**
     * @return Form
     */
    private function createContactForm()
    {
        $form = $this->createFormBuilder()
                     ->add('subject', ChoiceType::class,array(
                         "label" => "contactUs.subject",
                         "choices" => array(
                             "contactUs.subjectQuestion" => "contactUs.subjectQuestion",
                             "contactUs.subjectVideo" => "contactUs.subjectVideo",
                             "contactUs.subjectSubscribe" => "contactUs.subjectSubscribe",
                             "contactUs.subjectValid" => "contactUs.subjectValid",
                             "contactUs.subjectOther" => "contactUs.subjectOther"
                         )
                     ))
                    ->add('name', TextType::class,array(
                         "label" => "contactUs.name"
                     ))
                     ->add('email', EmailType::class,array(
                         "label" => "contactUs.email"
                     ))
                     ->add('message', TextareaType::class,array(
                         "label" => "contactUs.message"
                     ))
                     ->add('send', SubmitType::class,array(
                         "label" => "contactUs.send"
                     ))
                     ->getForm();

        return $form;
    }
}