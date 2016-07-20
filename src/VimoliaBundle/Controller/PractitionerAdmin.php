<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 20/07/2016
 * Time: 09:28
 */

namespace VimoliaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;

class PractitionerAdmin extends Controller
{
	/**
	 * @Route("/admin/practs/invalids", name="admin_displayInvalidPracts")
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function displayInvalidPractAction()
	{
		$this->checkAdminAuth();
		return $this->render('default/admin/practitioners/displayInvalidList.html.twig',array(
			'practs' => $this->getDoctrine()->getRepository('UserBundle:User')->getInvalidPracts()
		));
	}

	/**
	 * @Route("/admin/practs/valid/{id}", name="admin_practValid")
	 * @param User $user
	 *
	 * @return Response
	 */
	public function validPractAction(User $user)
	{
		$this->checkAdminAuth();
		$user->setPractValid(1);
		$this->getDoctrine()->getManager()->persist($user);
		$this->getDoctrine()->getManager()->flush();
		$this->get('session')->getFlashBag()->add('notice', 'Practicien validé');

		return $this->redirectToRoute('admin_displayInvalidPracts');
	}

	private function checkAdminAuth()
	{
		if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
			throw $this->createAccessDeniedException();
		}
	}
}