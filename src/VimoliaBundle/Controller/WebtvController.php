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
use Symfony\Component\HttpFoundation\Request;

class WebtvController extends Controller
{
    /**
     * @Route("/webtv/interviews", name="webtv_interviews")
     */
    public function displayInterviewsAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/webtv/displayInterviews.html.twig');
    }
    /**
     * @Route("/webtv/emissions", name="webtv_emissions")
     */
    public function displayEmissionsAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/webtv/displayEmissions.html.twig');
    }
    /**
     * @Route("/webtv/conferences", name="webtv_conferences")
     */
    public function displayConferencesAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/webtv/displayConferences.html.twig');
    }
}