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

class PractitionnerController extends Controller
{
    /**
     * @Route("/practitionners", name="practiciens")
     */
    public function displayPractitionnersAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/practitionner/displayPractitionners.html.twig');
    }

}