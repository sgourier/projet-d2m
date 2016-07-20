<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 16/05/2016
 * Time: 16:55
 */

namespace VimoliaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VimoliaBundle\Entity\Message;
use VimoliaBundle\Form\ReponseType;
use VimoliaBundle\Entity\Discussion;

class AdminQuestionsController extends Controller
{
    /**
     * @Route("/admin/newQuestions", name="adminNewQuestions")
     */
    public function displayNewQuestionsAction()
    {
        $this->checkAdminAuth();

        $em = $this->getDoctrine()->getManager();
        $discussions = $em->getRepository('VimoliaBundle:Discussion')
                          ->findBy(array("status" => "new", "active" => true),array("dateupd" => "DESC"));

        foreach($discussions as $discussion) {
            $question = $em->getRepository('VimoliaBundle:Message')
                           ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                          "idOwner" => $discussion->getIdMember(),
                                          "active" => true
                                    ));
            $discussion->setQuestion($question);

            $expert = $em->getRepository('UserBundle:User')
                          ->findOneBy(array("id" => $discussion->getIdExpert()));
            $discussion->setExpert($expert);

            $user = $em->getRepository('UserBundle:User')
                          ->findOneBy(array("id" => $discussion->getIdMember()));
            $discussion->setUser($user);
        }

        return $this->render('default/admin/questions/displayNewQuestions.html.twig', array(
            'discussions' => $discussions
        ));
    }

    /**
     * @Route("/admin/newQuestions/{idDiscussion}", name="adminNewQuestion")
     */
    public function displayNewQuestionAction($idDiscussion)
    {

        $this->checkAdminAuth();

        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository('VimoliaBundle:Discussion')
                          ->findOneBy(array("status" => "new", "active" => true, "id" => $idDiscussion));

        $question = $em->getRepository('VimoliaBundle:Message')
                       ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                        "idOwner" => $discussion->getIdMember(),
                                        "active" => true
                                  ));
        $discussion->setQuestion($question);

        $expert = $em->getRepository('UserBundle:User')
                      ->findOneBy(array("id" => $discussion->getIdExpert()));
        $discussion->setExpert($expert);

        $user = $em->getRepository('UserBundle:User')
                      ->findOneBy(array("id" => $discussion->getIdMember()));
        $discussion->setUser($user);

        $experts = $this->getDoctrine()->getRepository("UserBundle:User")->findByRole('ROLE_EXPERT');

        $practDomains = $em->getRepository('VimoliaBundle:Practdomains')
                           ->findAll();

        return $this->render('default/admin/questions/displayNewQuestion.html.twig', array(
            'discussion' => $discussion,
            'domaines' => $practDomains,
            'experts' => $experts
        ));
    }

    /**
     * @Route("/admin/newQuestions/{idDiscussion}/update", name="adminNewQuestion_update", defaults={"idDiscussion" = -1})
     * @ParamConverter("discussion", class="VimoliaBundle:Discussion", options={"id" = "idDiscussion"})
     * @param Discussion $discussion à mettre à jour
     * @param Request $request
     *
     * @return Response
     */
    public function updateNewDiscussionAction(Request $request, Discussion $discussion = null)
    {
        $this->checkAdminAuth();
        $em = $this->getDoctrine()->getManager();

        $idDomain = $request->request->get('domain');
        $domain = $em->getRepository('VimoliaBundle:Practdomains')
                          ->findOneBy(array("id" => $idDomain));
        $discussion->setDomain($domain);

        $idExpert = $request->request->get('expert');
        $expert = $em->getRepository('UserBundle:User')
                          ->findOneBy(array("id" => $idExpert));
        $discussion->setIdExpert($expert);

        $discussion->setStatus('expertAssociated');

        $em->persist($discussion);
        $em->flush();

        return $this->redirectToRoute('adminNewQuestions');
    }

    private function checkAdminAuth()
    {
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
        throw $this->createAccessDeniedException();
      }
    }

    /** Experts **/

    /**
     * @Route("/admin/myQuestions", name="adminExpertQuestions")
     */
    public function expertDisplayQuestionsAction()
    {
        $this->checkExpertAuth();

        $expert = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $discussions = $em->getRepository('VimoliaBundle:Discussion')
                          ->findBy(array("status" => ["expertAssociated", "advancedInfosFilled"],
                                         "idExpert" => $expert,
                                         "active" => true),array("dateupd" => "DESC"));

        foreach($discussions as $discussion) {
            $question = $em->getRepository('VimoliaBundle:Message')
                           ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                          "idOwner" => $discussion->getIdMember(),
                                          "active" => true
                                    ));
            $discussion->setQuestion($question);

            $expert = $em->getRepository('UserBundle:User')
                          ->findOneBy(array("id" => $discussion->getIdExpert()));
            $discussion->setExpert($expert);

            $user = $em->getRepository('UserBundle:User')
                          ->findOneBy(array("id" => $discussion->getIdMember()));
            $discussion->setUser($user);
        }

        return $this->render('default/admin/questions/displayExpertQuestions.html.twig', array(
            'discussions' => $discussions
        ));
    }

    /**
     * @Route("/admin/myQuestions/{idDiscussion}", name="adminExpertQuestion", defaults={"idDiscussion" = -1})
     * @ParamConverter("discussion", class="VimoliaBundle:Discussion", options={"id" = "idDiscussion"})
     * @param Discussion $discussion
     * @param Request $request
     *
     * @return Response
     */
    public function expertDisplayQuestionAction(Request $request, Discussion $discussion = null)
    {
        $this->checkExpertAuth();

        $expert = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository('VimoliaBundle:Discussion')
                          ->findOneBy(array("idExpert" => $expert,
                                            "id" => $discussion,
                                            "active" => true), array("dateupd" => "DESC"));

        $question = $em->getRepository('VimoliaBundle:Message')
                       ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                      "idOwner" => $discussion->getIdMember(),
                                      "active" => true
                                ));
        $discussion->setQuestion($question);

        $expert = $em->getRepository('UserBundle:User')
                      ->findOneBy(array("id" => $discussion->getIdExpert()));
        $discussion->setExpert($expert);

        $user = $em->getRepository('UserBundle:User')
                      ->findOneBy(array("id" => $discussion->getIdMember()));
        $discussion->setUser($user);

        $advancedInfos = $em->getRepository('VimoliaBundle:AdvancedInfos')
                       ->findOneBy(array("id" => $discussion->getIdAdvancedinfos()));
        $discussion->setAdvancedInfos($advancedInfos);

        $messageForm = $this->createForm(ReponseType::class, new Message(),array('method'=>'POST', 'action' => $this->generateUrl('adminExpertQuestion_update', array('idDiscussion' => $discussion->getId()))));

        $domain = $em->getRepository('VimoliaBundle:Practdomains')
                     ->findOneBy(array("id" => $discussion->getDomain()));

        $practiciens = $this->getDoctrine()->getRepository("UserBundle:User")->findPracticiensByDomain($domain->getId());

        return $this->render('default/admin/questions/displayExpertQuestion.html.twig', array(
            'discussion' => $discussion,
            'reponseForm' => $messageForm->createView(),
            'practiciens' => $practiciens
        ));
    }

    /**
     * @Route("/admin/myQuestions/{idDiscussion}/update", name="adminExpertQuestion_update", defaults={"idDiscussion" = -1})
     * @ParamConverter("discussion", class="VimoliaBundle:Discussion", options={"id" = "idDiscussion"})
     * @param Discussion $discussion à mettre à jour
     * @param Request $request
     *
     * @return Response
     */
    public function adminQuestion_attributeToPract() {
        
    }

    /**
     * @Route("/admin/myQuestions/{idDiscussion}/update", name="adminExpertQuestion_update", defaults={"idDiscussion" = -1})
     * @ParamConverter("discussion", class="VimoliaBundle:Discussion", options={"id" = "idDiscussion"})
     * @param Discussion $discussion à mettre à jour
     * @param Request $request
     *
     * @return Response
     */
    public function updateExpertDiscussionAction(Request $request, Discussion $discussion = null)
    {
        $this->checkExpertAuth();

        $discussion->setStatus('expertResponded');

        $newReponse = new Message();
        $newReponse->setIdOwner($this->getUser());
        $newReponse->setIdDiscussion($discussion);

        $form = $this->createForm(ReponseType::class, $newReponse);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($newReponse);
            $em->persist($discussion);
            $em->flush();

            return $this->redirectToRoute('adminExpertQuestions');
        }

        return $this->render('default/admin/questions/displayExpertQuestion.html.twig', array(
            'discussion' => $discussion,
            'reponseForm' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/myQuestions/{idDiscussion}/update_waiting", name="adminExpertQuestion_update_waiting", defaults={"idDiscussion" = -1})
     * @ParamConverter("discussion", class="VimoliaBundle:Discussion", options={"id" = "idDiscussion"})
     * @param Discussion $discussion à mettre à jour
     * @param Request $request
     *
     * @return Response
     */
    public function updateExpertDiscussionWaitingAction(Request $request, Discussion $discussion = null)
    {
        $this->checkExpertAuth();

        $discussion->setStatus('waitingAdvancedInfos');

        $em = $this->getDoctrine()->getManager();

        $em->persist($discussion);
        $em->flush();

        return $this->redirectToRoute('adminExpertQuestions');
    }

    private function checkExpertAuth()
    {
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_EXPERT')) {
        throw $this->createAccessDeniedException();
      }
    }

}