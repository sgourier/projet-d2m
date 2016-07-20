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
        $em = $this->getDoctrine()->getManager();
        $aboutUs = $em->getRepository('VimoliaBundle:Aboutus')
                          ->findAll();
        $aboutUs = $aboutUs[0]->getDescription();
        $cgu = $em->getRepository('VimoliaBundle:Cgu')
                  ->findAll();
        $cgu = $cgu[0]->getText();

        return $this->render('default/informations/displayInformations.html.twig', array(
        	'aboutUs' => $aboutUs,
        	'cgu' => $cgu
        ));
    }

}