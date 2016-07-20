<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends Controller
{
    /**
     * Show the user
     */
    public function showAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $questionOpt = array();

	    if($this->get('security.authorization_checker')->isGranted('ROLE_PRACTITIONER'))
	    {
	    	$questionOpt['idPract'] = $user->getId();
	    }
	    else
	    {
		    $questionOpt['idMember'] = $user->getId();
	    }

	    $em = $this->getDoctrine()->getManager();
	    $lastQuestion = $this->getDoctrine()->getRepository('VimoliaBundle:Discussion')->findOneBy($questionOpt,array('dateupd'=>'DESC'));
	    if(is_object($lastQuestion))
	    {
		    $question = $em->getRepository('VimoliaBundle:Message')
		                   ->findOneBy(array("idDiscussion" => $lastQuestion->getId(),
		                                     "idOwner" => $lastQuestion->getIdMember(),
		                                     "active" => true
		                   ));
		    $lastQuestion->setQuestion($question);
	    }

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'lastQuestion' => $lastQuestion
        ));
    }

    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $oldFile = $user->getAvatarPath();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $filePath = $this->getParameter('user_directory').'/'.$user->getId().'/'.$user->getAvatarPath();
        if(is_string($user->getAvatarPath()) && $user->getAvatarPath() != "" && file_exists($filePath))
        {
            $user->setAvatarPath(
                new File($filePath)
            );
        }

        $form = $formFactory->createForm();
        $form->setData($user);


        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            if($user->getAvatarPath() !== null)
            {
                /** @var UploadedFile $file */
                $file = $user->getAvatarPath();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move(
                    $this->getParameter('user_directory').'/'.$user->getId(),
                    $fileName
                );
            }
            else if($form['keepImg']->getData() == 1)
            {
                $fileName = $oldFile;
            }
            else
            {
                if($oldFile != null && $oldFile != "")
                {
                    unlink($filePath);
                }
                $fileName = "";
            }

            $user->setAvatarPath($fileName);

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
            'avatar' => $oldFile
        ));
    }
}
