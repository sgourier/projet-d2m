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
use VimoliaBundle\Form\MessageType;

class QuestionsController extends Controller
{
    /**
     * @Route("/questions", name="questions")
     */
    public function displayQuestionsAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/questions/displayQuestions.html.twig');
    }


    /**
     * @Route("/questions/new", name="questions_new")
     */
    public function displayNewAction()
    {

        $form = $this->createForm(MessageType::class, new Message(),array('method'=>'POST', 'action' => $this->generateUrl('questions_saveMessageForm')));

        // replace this example code with whatever you need
        return $this->render('default/questions/displayNewQuestions.html.twig', array(
            'form' => $form->createView()
        ));
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

    }
}