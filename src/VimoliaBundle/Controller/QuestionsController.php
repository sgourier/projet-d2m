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
            $question = $em->getRepository('VimoliaBundle:Message')
                           ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                          "idOwner" => $discussion->getIdMember(),
                                          "active" => true
                                    ));
            $discussion->setQuestion($question);

            $reponse = $em->getRepository('VimoliaBundle:Message')
                          ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                         "idOwner" => $discussion->getIdExpert(),
                                         "active" => true
                                    ));
            $discussion->setReponse($reponse);
        }

        return $this->render('default/questions/displayQuestions.html.twig', array(
            'discussions' => $discussions
        ));
    }

    /**
     * @Route("/profile/questions", name="own_questions")
     */
    public function displayOwnQuestionsAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $discussions = $em->getRepository('VimoliaBundle:Discussion')
                          ->findBy(array("idMember" => $this->getUser()), array("dateupd" => "DESC"));

        foreach($discussions as $discussion) {
            $question = $em->getRepository('VimoliaBundle:Message')
                           ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                          "idOwner" => $discussion->getIdMember(),
                                          "active" => true
                                    ));
            $discussion->setQuestion($question);
        }

        return $this->render('default/questions/displayOwnQuestions.html.twig', array(
            'discussions' => $discussions
        ));
    }

    /**
     * @Route("/profile/questions/{idDiscussion}", name="own_question")
     */
    public function displayOwnQuestionAction($idDiscussion)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository('VimoliaBundle:Discussion')
                          ->findOneBy(array("idMember" => $this->getUser(), "id" => $idDiscussion), array("dateupd" => "DESC"));

        $question = $em->getRepository('VimoliaBundle:Message')
                       ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                      "idOwner" => $discussion->getIdMember(),
                                      "active" => true
                                ));
        $discussion->setQuestion($question);

        $reponse = $em->getRepository('VimoliaBundle:Message')
                      ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                     "idOwner" => $discussion->getIdExpert(),
                                     "active" => true
                                ));
        $discussion->setReponse($reponse);

        return $this->render('default/questions/displayOwnQuestion.html.twig', array(
            'discussion' => $discussion
        ));
    }


    /**
     * @Route("/questions/new", name="questions_new")
     */
    public function displayNewQuestionAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

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
        $newDiscussion = new Discussion();
        $newDiscussion->setIdMember($this->getUser());

        $newMessage = new Message();
        $newMessage->setIdOwner($this->getUser());

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