<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 16/05/2016
 * Time: 16:51
 */

namespace VimoliaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use VimoliaBundle\Admin\UserAdmin;

class AdminUsersController extends Controller
{
  # public function newAction(Request $request)
  # {
  #     $avatarPath = new User();
  #     $admin = $this->createForm(UserAdmin::class, $avatarPath);
  #     $admin->handleRequest($request);

  #     if ($admin->isSubmitted() && $admin->isValid()) {
  #         // $file stores the uploaded file
  #         $file = $avatarPath->getAvatarPath();

  #         // Generate a unique name for the file before saving it
  #         $fileName = md5(uniqid()).'.'.$file;

  #         // Update the 'avatar' property to store the file name
  #         // instead of its contents
  #         $avatarPath->setAvatarPath($fileName);

  #         // ... persist the $product variable or any other work

  #     }

  #     return $this->render('images.html.twig', array(
  #         'form' => $form->createView(),
  #     ));
  # }
}