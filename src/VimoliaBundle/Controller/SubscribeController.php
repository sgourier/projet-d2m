<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 16/05/2016
 * Time: 16:56
 */

namespace VimoliaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SubscribeController extends Controller
{

    /**
     * @Route("/subscribe", name="abonnements_infos")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();
        $abonnements = $em->getRepository('VimoliaBundle:Subscribetype')
            ->findAll();



        return $this->render('default/subscribe/showOffers.html.twig', [
            "abonnements" => $abonnements
        ]);
    }
}