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

class PartnersController extends Controller
{
    /**
     * @Route("/partners", name="partners")
     */
    public function displayPartnersAction() {

        $em = $this->getDoctrine()->getManager();

        $partners = $em->getRepository('VimoliaBundle:Partners')
                        ->findAll();


        return $this->render('default/Partners/displayPartners.html.twig', array(
            'videos' => $partners
        ));
    }
}