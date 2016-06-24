<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 16/05/2016
 * Time: 16:55
 */

namespace VimoliaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VimoliaBundle\Entity\Message;
use VimoliaBundle\Entity\Discussion;
use VimoliaBundle\Form\MessageType;

class QuestionsController extends Controller
{
    /**
     * @Route("/questions", name="questions")
     */
    public function displayQuestionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $discussions = $em->getRepository('VimoliaBundle:Discussion')
                          ->findBy(array("public" => true, "status" => "expertResponded", "active" => true),array("dateupd" => "DESC"));

        foreach($discussions as $discussion) {
            $messages = $em->getRepository('VimoliaBundle:Message')
                           ->findBy(array("idDiscussion" => $discussion->getId(), "active" => true),array("dateupd" => "ASC"));
            $discussion->setMessages($messages);
        }

        return $this->render('default/questions/displayQuestions.html.twig', array(
            'discussions' => $discussions
        ));
    }


    /**
     * @Route("/questions/new", name="questions_new")
     */
    public function displayNewQuestionAction()
    {

        $form = $this->createForm(MessageType::class, new Message(),array('method'=>'POST', 'action' => $this->generateUrl('questions_saveMessageForm')));

        return $this->render('default/questions/displayNewQuestions.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/questions/confirm", name="questions_confirm")
     */
    public function displayConfirmQuestions()
    {
        return $this->render('default/questions/displayConfirmQuestions.html.twig');
    }

    /**
     * @Route("/questions/save", name="questions_saveMessageForm")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function saveMessageFormAction(Request $request)
    {
        /* To Do save id_owner in $newMessage and $id_member in $newDiscussion */

        $newDiscussion = new Discussion();
        $newMessage = new Message();

        $form = $this->createForm(MessageType::class, $newMessage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($newDiscussion);
            $newMessage->setIdDiscussion($newDiscussion);
            $em->persist($newMessage);
            $em->flush();

            return $this->redirectToRoute('questions_confirm');
        }

        return $this->render('default/questions/displayNewQuestions.html.twig',array(

        ));
    }
}