<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 16/05/2016
 * Time: 16:50
 */

namespace VimoliaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminArticleController
{
    /**
     * @Route("/{id}", name="admin_post_show")
     */

    public function showAction($id)
    {
    }

    /**
     * @Route("/edit/{id}")
     * @Method({"GET", "POST"})
     */

    public function editAction($id)
    {
    }
}