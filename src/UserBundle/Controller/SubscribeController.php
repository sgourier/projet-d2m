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
use VimoliaBundle\Entity\Subscribe;
use VimoliaBundle\Entity\Subscribetype;

class SubscribeController extends Controller
{
	/**
	 * @Route("/chooseSubscribe", name="user_chooseSubscribe")
	 *
	 * @param boolean $error
	 *
	 * @return Response
	 */
	public function chooseSubscribeAction($error = false)
	{
		$this->checkPractAuth();

		if($this->getUser()->getPractValid())
		{
			$offers = $this->getDoctrine()->getRepository("VimoliaBundle:Subscribetype")->findBy(array("active" => true));

			return $this->render(":default/subscribe:chooseOffer.html.twig",array(
				"offers" => $offers,
				"error" => $error,
				"user" => $this->getUser()
			));
		}

		return $this->redirectToRoute("fos_user_profile_show");
	}

	/**
	 * @Route("/generateSubscribe/{id}", name="user_generateSubscribe")
	 *
	 * @param SubscribeType $type type d'abonnement demandé
	 *
	 * @return Response
	 */
	public function genrateSubscribeAction(Subscribetype $type)
	{
		if($type->getActive())
		{
			$items = array(
				array(
					"name" => $type->getName(),
					"currency" => 'EUR',
					"quantity" => 1,
					"ref" => uniqid(),
					"price" => $type->getPrice()
				)
			);

			$routeName = "payment_callback";
			$shippingPrice = 0;

			$paymentRoute = $this->get('service_container')->get('paypal_interface')->createExpressPayment($items,$routeName,$shippingPrice,$type->getId());

			return $this->redirect($paymentRoute);
		}

		return $this->redirectToRoute("user_chooseSubscribe",array
		(
			"error" => true
		));
	}

	/**
	 * @Route("/paymentCallback/{id}/{result}", name="payment_callback")
	 *
	 * @param Request $request
	 * @param string $result
	 * @param Subscribetype $type
	 *
	 * @return Response
	 */
	public function callBackSubscribeAction(Request $request,$result,Subscribetype $type)
	{
		$user = $this->getUser();
		if($result == "ok" && $user->getPractValid() == true)
		{
			$paymentId = $request->query->get('paymentId');
			$payerId = $request->query->get('PayerID');
			$this->get('service_container')->get('paypal_interface')->paymentExecution($paymentId,$payerId);

			$sub = $this->getDoctrine()->getRepository('VimoliaBundle:Subscribe')->findOneBy(array("idUser"=>$this->getUser()));

			if(!is_object($sub))
			{
				$sub = new Subscribe();
				$sub->setIdUser($user);
			}
			
			$sub->setEndDate($sub->getEndDate()->add(new \DateInterval('P'.$type->getTime().'M')));
			$sub->setIdCommand($paymentId);
			$sub->setIdPayer($payerId);
			$sub->setIdSubscribetype($type);

			$this->getDoctrine()->getManager()->persist($sub);
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute("fos_user_profile_show");
		}

		return $this->redirectToRoute("user_chooseSubscribe",array
		(
			"error" => true
		));	
	}

	private function checkPractAuth()
	{
		if (!$this->get('security.authorization_checker')->isGranted('ROLE_PRACTITIONER')) {
			throw $this->createAccessDeniedException();
		}
	}
}