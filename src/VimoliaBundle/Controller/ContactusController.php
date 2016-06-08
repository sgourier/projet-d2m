<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 16/05/2016
 * Time: 16:54
 */

namespace VimoliaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactusController extends Controller
{
    /**
     * @Route("/contactus", name="contactus")
     */
    public function displayContactusAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/contactus/displayContactus.html.twig');
    }
}