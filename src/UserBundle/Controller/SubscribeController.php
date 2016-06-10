<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 07/06/2016
 * Time: 18:23
 */

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscribeController extends Controller
{
	/**
	 * @Route("/chooseSubscribe", name="user_chooseSubscribe")
	 *
	 * @return Response
	 */
	public function chooseSubscribeAction()
	{
		$this->checkPractAuth();

		$offers = $this->getDoctrine()->getRepository("VimoliaBundle:Subscribetype")->findBy(array("active" => true));
		
		return $this->render(":default/subscribe:chooseOffer.html.twig",array(
			"offers" => $offers
		));
	}

	private function checkPractAuth()
	{
		if (!$this->get('security.authorization_checker')->isGranted('ROLE_PRACTITIONER')) {
			throw $this->createAccessDeniedException();
		}
	}
}