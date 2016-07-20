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
use VimoliaBundle\Entity\Discussion;
use VimoliaBundle\Entity\Practdomains;
use VimoliaBundle\Form\MessageType;

class QuestionsController extends Controller
{
    /**
     * @Route("/questions/{id_domain}", name="questions", defaults={"id_domain" = -1})
     * @ParamConverter("domain", class="VimoliaBundle:Practdomains", options={"id" = "id_domain"})
     *
     * @param Practdomains $domain domaine d'expertise sur lequel filtrer
     * @param Request $request
     *
     * @return Response
     */
    public function displayQuestionsAction(Request $request, Practdomains $domain = null)
    {
        $page = $request->query->getInt('page', 1);

        $em = $this->getDoctrine()->getManager();

        $discussions = $this->findQuestions($this->get('knp_paginator'),$domain,$page);
        
        foreach($discussions as $discussion) {
            $question = $em->getRepository('VimoliaBundle:Message')
                           ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                          "idOwner" => $discussion->getIdMember(),
                                          "active" => true
                                    ));
            $discussion->setQuestion($question);

            $reponse = $em->getRepository('VimoliaBundle:Message')
                          ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                         "idOwner" => $discussion->getIdExpert(),
                                         "active" => true
                                    ));
            $discussion->setReponse($reponse);

            $expert = $em->getRepository('UserBundle:User')
                          ->findOneBy(array("id" => $discussion->getIdExpert()));
            $discussion->setExpert($expert);

            $user = $em->getRepository('UserBundle:User')
                          ->findOneBy(array("id" => $discussion->getIdMember()));
            $discussion->setUser($user);
        }

        return $this->render('default/questions/displayQuestions.html.twig', array(
            "domains" => $this->getDoctrine()->getRepository("VimoliaBundle:Practdomains")->findAll(),
            'discussions' => $discussions,
            "sDomain" => $domain
        ));
    }

    private function findQuestions($paginator,$domain = null,$page = 1)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQueryBuilder()
                      ->select('a')
                      ->from('VimoliaBundle:Discussion', 'a')
                      ->where('a.public = true')
                      ->andWhere('a.status = :status1 OR a.status = :status2')
                      ->setParameter('status1', 'expertResponded')
                      ->setParameter('status2', 'finished')
                      ->andWhere('a.active = true');                      

        if($domain != null)
        {
            $query->andWhere('a.domain = :domain')
                    ->setParameter('domain', $domain);
        }

        $query->addOrderBy('a.dateupd', 'DESC');

        return $paginator->paginate(
            $query, $page,10
        );
    }

    /**
     * @Route("/question/{idDiscussion}", name="question", defaults={"idDiscussion" = -1})
     * @ParamConverter("discussion", class="VimoliaBundle:Discussion", options={"id" = "idDiscussion"})
     * @param Discussion $discussion
     * @param Request $request
     *
     * @return Response
     */
    public function displayQuestionAction(Request $request, Discussion $discussion = null)
    {
        $em = $this->getDoctrine()->getManager();

        $question = $em->getRepository('VimoliaBundle:Message')
                       ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                      "idOwner" => $discussion->getIdMember(),
                                      "active" => true
                                ));
        $discussion->setQuestion($question);

        $reponse = $em->getRepository('VimoliaBundle:Message')
                      ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                     "idOwner" => $discussion->getIdExpert(),
                                     "active" => true
                                ));
        $discussion->setReponse($reponse);

        $expert = $em->getRepository('UserBundle:User')
                      ->findOneBy(array("id" => $discussion->getIdExpert()));
        $discussion->setExpert($expert);

        $user = $em->getRepository('UserBundle:User')
                      ->findOneBy(array("id" => $discussion->getIdMember()));
        $discussion->setUser($user);

        return $this->render('default/questions/displayQuestion.html.twig', array(
            'discussion' => $discussion
        ));
    }

    /**
     * @Route("/profile/questions", name="own_questions")
     */
    public function displayOwnQuestionsAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        if( $this->get('security.authorization_checker')->isGranted('ROLE_PRACTITIONER')) {
          $discussions = $em->getRepository('VimoliaBundle:Discussion')
                            ->findBy(array("idPract" => $this->getUser(),
                                           "status" => "practAttributed"), array("dateupd" => "DESC"));

          foreach($discussions as $discussion) {
              $question = $em->getRepository('VimoliaBundle:Message')
                             ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                            "idOwner" => $discussion->getIdMember(),
                                            "active" => true
                                      ));
              $discussion->setQuestion($question);

              $user = $em->getRepository('UserBundle:User')
                            ->findOneBy(array("id" => $discussion->getIdMember()));
              $discussion->setUser($user);
          }
        } else {
          $discussions = $em->getRepository('VimoliaBundle:Discussion')
                            ->findBy(array("idMember" => $this->getUser()), array("dateupd" => "DESC"));

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
        }

        return $this->render('default/questions/displayOwnQuestions.html.twig', array(
            'discussions' => $discussions
        ));
    }

    /**
     * @Route("/profile/questions/{idDiscussion}", name="own_question")
     */
    public function displayOwnQuestionAction($idDiscussion)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        if( $this->get('security.authorization_checker')->isGranted('ROLE_PRACTITIONER')) {
          $discussion = $em->getRepository('VimoliaBundle:Discussion')
                          ->findOneBy(array("idPract" => $this->getUser(), "id" => $idDiscussion), array("dateupd" => "DESC"));

          $question = $em->getRepository('VimoliaBundle:Message')
                         ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                          "idOwner" => $discussion->getIdMember(),
                                          "active" => true
                                    ));
          $discussion->setQuestion($question);

          $reponse = $em->getRepository('VimoliaBundle:Message')
                        ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                       "idOwner" => $discussion->getIdExpert(),
                                       "active" => true
                                  ));
          $discussion->setReponse($reponse);

          $advancedInfos = $em->getRepository('VimoliaBundle:AdvancedInfos')
                         ->findOneBy(array("id" => $discussion->getIdAdvancedinfos()));
          $discussion->setAdvancedInfos($advancedInfos);

          $user = $em->getRepository('UserBundle:User')
                        ->findOneBy(array("id" => $discussion->getIdMember()));
          $discussion->setUser($user);
        } else {
          $discussion = $em->getRepository('VimoliaBundle:Discussion')
                          ->findOneBy(array("idMember" => $this->getUser(), "id" => $idDiscussion), array("dateupd" => "DESC"));

          $question = $em->getRepository('VimoliaBundle:Message')
                         ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                        "idOwner" => $discussion->getIdMember(),
                                        "active" => true
                                  ));
          $discussion->setQuestion($question);

          $reponse = $em->getRepository('VimoliaBundle:Message')
                        ->findOneBy(array("idDiscussion" => $discussion->getId(),
                                       "idOwner" => $discussion->getIdExpert(),
                                       "active" => true
                                  ));
          $discussion->setReponse($reponse);

          $advancedInfos = $em->getRepository('VimoliaBundle:AdvancedInfos')
                         ->findOneBy(array("id" => $discussion->getIdAdvancedinfos()));
          $discussion->setAdvancedInfos($advancedInfos);

          $expert = $em->getRepository('UserBundle:User')
                        ->findOneBy(array("id" => $discussion->getIdExpert()));
          $discussion->setExpert($expert);

          $user = $em->getRepository('UserBundle:User')
                        ->findOneBy(array("id" => $discussion->getIdMember()));
          $discussion->setUser($user);
        }

        return $this->render('default/questions/displayOwnQuestion.html.twig', array(
            'discussion' => $discussion
        ));
    }

    /**
     * @Route("/profile/questions/{idDiscussion}/feedbackSave", name="own_question_feedback_save", defaults={"idDiscussion" = -1})
     * @ParamConverter("discussion", class="VimoliaBundle:Discussion", options={"id" = "idDiscussion"})
     * @param Discussion $discussion
     * @param Request $request
     *
     * @return Response
     */
    public function ownQuestionFeedbackSave(Request $request, Discussion $discussion = null) {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $note = $request->request->get('note');
        $discussion->setFeedback($note);
        $isPublic = $request->request->get('public');
        $isPublic = $isPublic === 'on' ? 1 : 0;
        $discussion->setPublic($isPublic);
        $discussion->setStatus('finished');

        $em = $this->getDoctrine()->getManager();
        $em->persist($discussion);
        $em->flush();

        return $this->redirectToRoute('ownQuestionFeedbackConfirm');
    }

    /**
    * @Route("/profile/confirm_feedback", name="ownQuestionFeedbackConfirm")
    */
    public function displayConfirmFeedback()
    {
        return $this->render('default/questions/displayConfirmFeedback.html.twig');
    }


    /**
     * @Route("/questions_new", name="questions_new")
     */
    public function displayNewQuestionAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(MessageType::class, new Message(),array('method'=>'POST', 'action' => $this->generateUrl('questions_saveMessageForm')));

        return $this->render('default/questions/displayNewQuestions.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/questions_confirm", name="questions_confirm")
     */
    public function displayConfirmQuestions()
    {
        return $this->render('default/questions/displayConfirmQuestions.html.twig');
    }

    /**
     * @Route("/questions_save", name="questions_saveMessageForm")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function saveMessageFormAction(Request $request)
    {
        $newDiscussion = new Discussion();
        $newDiscussion->setIdMember($this->getUser());

        $newMessage = new Message();
        $newMessage->setIdOwner($this->getUser());

        $form = $this->createForm(MessageType::class, $newMessage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($newDiscussion);
            $newMessage->setIdDiscussion($newDiscussion);
            $em->persist($newMessage);
            $em->flush();

            return $this->redirectToRoute('questions_confirm');
        }

        return $this->render('default/questions/displayNewQuestions.html.twig',array(

        ));
    }
}