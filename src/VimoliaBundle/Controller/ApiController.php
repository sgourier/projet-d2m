<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 16/05/2016
 * Time: 16:56
 */

namespace VimoliaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use VimoliaBundle\Entity\Discussion;

class ApiController extends Controller
{
	/**
     * @Route("/admin/api/waitingQuestions", name="waitingQuestions")
     */
    public function displaywaitingQuestionsAction()
    {
    	$em = $this->getDoctrine()->getManager();
        $adminDiscussions = $em->getRepository('VimoliaBundle:Discussion')
                          ->findBy(array("status" => "new", "active" => true));
        $expertDiscussions = $em->getRepository('VimoliaBundle:Discussion')
                          ->findBy(array("status" => ["expertAssociated", "advancedInfosFilled"], "active" => true));
        $userDiscussions = $em->getRepository('VimoliaBundle:Discussion')
                          ->findBy(array("status" => "waitingAdvancedInfos", "active" => true));
        $practsDiscussions = $em->getRepository('VimoliaBundle:Discussion')
                          ->findBy(array("status" => "practAttributed", "active" => true));

        $discussions = [
        	"categories" => ["Administrateur", "Expert", "Utilisateur", "Praticien"],
        	"data" => [count($adminDiscussions), count($expertDiscussions), count($userDiscussions), count($practsDiscussions)]
        ];
        return new JsonResponse($discussions);    
    }

    /**
     * @Route("/admin/api/usersCount", name="usersCount")
     */
    public function displayUsersCount() {
    	$memebres = $this->getDoctrine()->getRepository("UserBundle:User")->findByRole('ROLE_MEMBER');
    	$experts = $this->getDoctrine()->getRepository("UserBundle:User")->findByRole('ROLE_EXPERT');
    	$practionners = $this->getDoctrine()->getRepository("UserBundle:User")->findByRole('ROLE_PRACTITIONER');
    	$admins = $this->getDoctrine()->getRepository("UserBundle:User")->findByRole('ROLE_SUPER_ADMIN');

    	$discussions = [
        	"categories" => ["Membres", "Experts", "Praticiens", "Administrateurs"],
        	"data" => [count($memebres), count($experts), count($practionners), count($admins)]
        ];
        return new JsonResponse($discussions);
    }

    /**
     * @Route("/admin/api/practiciensPerDomain", name="practiciensPerDomain")
     */
    public function displayPracticiensPerDomain() {
      $em = $this->getDoctrine()->getManager();
      $domains = $em->getRepository('VimoliaBundle:PractDomains')
                    ->findAll();

      $domainsCount = [];
      foreach ($domains as $domain) {
        $practs = $this->getDoctrine()->getRepository("UserBundle:User")->findPracticiensByDomain($domain->getId());
        $domainsCount[] = ["name" =>$domain->getName(), "y" => count($practs)];
      }
      return new JsonResponse($domainsCount);
    }
}