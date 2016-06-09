<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 16/05/2016
 * Time: 16:53
 */

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\Practinfos;
use UserBundle\Form\PractInfosType;

class PractitionerBundle extends Controller
{
	/**
	 * @Route("/newPractForm", name="user_newPractForm")
	 *
	 * @return Response
	 */
	public function newPractFormAction()
	{
		$this->checkPractAuth();
		$user = $this->getUser();

		if($user->getPractinfos() != null)
		{
			return $this->redirectToRoute('user_updatePractForm');
		}

		$practInfos = new Practinfos();
		$user->setPractinfos($practInfos);

		$this->getDoctrine()->getManager()->persist($practInfos);
		$this->getDoctrine()->getManager()->persist($user);
		$this->getDoctrine()->getManager()->flush();

		$form = $this->createForm(PractInfosType::class,new Practinfos(),array('method'=>'POST', 'action' => $this->generateUrl('user_savePractForm')));

		return $this->render(':default/practitionner:newPractInfos.html.twig',array(
			'form' => $form->createView()
		));
	}

	/**
	 * @Route("/practForm", name="user_updatePractForm")
	 *
	 * @return Response
	 */
	public function updatePractFormAction()
	{
		$this->checkPractAuth();
		$practInfos = $this->getUser()->getPractinfos();

		$form = $this->createForm(PractInfosType::class,$practInfos,array('method'=>'POST', 'action' => $this->generateUrl('user_savePractForm')));

		return $this->render(':default/practitionner:updatePractProfile.html.twig',array(
			'form' => $form->createView()
		));
	}

	/**
	 * @Route("/savePractForm", name="user_savePractForm")
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function savePractFormAction(Request $request)
	{
		$this->checkPractAuth();
		
		$practInfos = $this->getUser()->getPractinfos();

		$form = $this->createForm(PractInfosType::class,$practInfos);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			$this->getDoctrine()->getManager()->persist($practInfos);
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('task_success');
		}
		return $this->render(':default/practitionner:updatePractProfile.html.twig',array(

		));
	}
	
	private function checkPractAuth()
	{
		if (!$this->get('security.authorization_checker')->isGranted('ROLE_PRACTITIONER')) {
			throw $this->createAccessDeniedException();
		}
	}
}