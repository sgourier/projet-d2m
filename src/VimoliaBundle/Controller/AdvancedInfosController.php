<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 16/05/2016
 * Time: 16:55
 */

namespace VimoliaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VimoliaBundle\Entity\Advancedinfos;
use VimoliaBundle\Form\AdvancedinfosType;

class AdvancedInfosController extends Controller
{
  /**
   * @Route("/advancedInfos/new", name="advancedInfos")
   */
  public function displayNewadvancedInfosAction()
  {
      if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
          throw $this->createAccessDeniedException();
      }

      $form = $this->createForm(AdvancedinfosType::class, new Advancedinfos(),array('method'=>'POST', 'action' => $this->generateUrl('advancedInfos_saveForm')));

      return $this->render('default/advancedInfos/displayNewAdvancedInfos.html.twig', array(
          'form' => $form->createView()
      ));
  }

  /**
   * @Route("/advancedInfos/confirm", name="advancedInfos_confirm")
   */
  public function displayConfirmAdvancedInfos()
  {
      return $this->render('default/advancedInfos/displayConfirmAdvancedInfos.html.twig');
  }

  /**
   * @Route("/advancedInfos/save", name="advancedInfos_saveForm")
   *
   * @param Request $request
   *
   * @return Response
   */
  public function saveAdvancedInfosFormAction(Request $request)
  {
      $newAdvancedinfos = new Advancedinfos();

      $form = $this->createForm(AdvancedinfosType::class, $newAdvancedinfos);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid())
      {
          $em = $this->getDoctrine()->getManager();

          $em->persist($newAdvancedinfos);
          $em->persist($newAdvancedinfos);
          $em->flush();

          return $this->redirectToRoute('advancedInfos_confirm');
      }

      return $this->render('default/advancedInfos/displayAdvancedInfos.html.twig',array(

      ));
  }
}