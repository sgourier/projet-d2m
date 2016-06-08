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

class InformationsController extends Controller
{
    /**
     * @Route("/informations", name="informations")
     */
    public function displayInformationsAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/informations/displayInformations.html.twig');
    }
}