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
use UserBundle\Entity\User;

class PractitionerBundle extends Controller
{
	/**
	 * @Route("/practForm", name="user_updatePractForm")
	 *
	 * @return Response
	 */
	public function updatePractFormAction()
	{
		$this->checkPractAuth();
		
		$practInfos = $this->getUser()->getPractinfos();
		
		if($practInfos == null)
		{
			$practInfos = new Practinfos();
			$user = $this->getUser();
			$user->setPractinfos($practInfos);
			$this->getDoctrine()->getManager()->persist($practInfos);
			$this->getDoctrine()->getManager()->persist($user);
			$this->getDoctrine()->getManager()->flush();
		}

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

			return $this->redirectToRoute('fos_user_profile_show');
		}

		return $this->render(':default/practitionner:updatePractProfile.html.twig',array(
			
		));
	}

	/**
	 * @Route("/proPage/{idPract}", name="user_proPage")
	 */
	public function showProPage(User $pract)
	{
		return $this->render(":default/practitionner:practProfile.html.twig",array(
			"pract" => $pract
		));
	}
	
	private function checkPractAuth()
	{
		if (!$this->get('security.authorization_checker')->isGranted('ROLE_PRACTITIONER')) {
			throw $this->createAccessDeniedException();
		}
	}
}