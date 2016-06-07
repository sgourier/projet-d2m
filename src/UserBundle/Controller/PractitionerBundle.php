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
	 * @Route("/practForm/{id}", name="user_updatePractForm")
	 *
	 * @param integer $id id de la fiche du praticien
	 *
	 * @return Response
	 */
	public function updatePractFormAction($id)
	{
		if($id != 0)
		{
			$practInfos = $this->getDoctrine()->getRepository('UserBundle:Practinfos')->find($id);
		}
		else
		{
			$practInfos = new Practinfos();
		}
		
		$form = $this->createForm(new PractInfosType(),$practInfos,array('method'=>'POST', 'action' => $this->generateUrl('user_savePractForm')));

		return $this->render(':default/practitionner:updatePractProfile.html.twig',array(
			'form' => $form->createView()
		));
	}

	/**
	 * @Route("/savePractForm/{id}", name="user_savePractForm")
	 *
	 * @param integer $id id de la fiche du praticien
	 *
	 * @return Response
	 */
	public function savePractFormAction($id)
	{
		return $this->render(':default/practitionner:updatePractProfile.html.twig',array(

		));
	}
}