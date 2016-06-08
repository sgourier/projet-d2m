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
        // replace this example code with whatever you need
        return $this->render('default/questions/displayNewQuestions.html.twig');
    }
}