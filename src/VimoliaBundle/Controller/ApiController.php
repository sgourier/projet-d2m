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

	/**
	 * @Route("/admin/api/agePyramid", name="agePyramid")
	 */
    public function agePyramidAction()
    {
	    $users      = $this->getDoctrine()->getRepository( 'UserBundle:User' )->findBy( array( 'enabled' => 1 ) );
	    $categories = array(
		    '0-4',
		    '5-9',
		    '10-14',
		    '15-19',
		    '20-24',
		    '25-29',
		    '30-34',
		    '35-39',
		    '40-44',
		    '45-49',
		    '50-54',
		    '55-59',
		    '60-64',
		    '65-69',
		    '70-74',
		    '75-79',
		    '80-84',
		    '85-89',
		    '90-94',
		    '95-99',
		    '100 + '
	    );

	    $categoriesPlace = array(
		    array( 0, 0, 4 ),
		    array( 1, 5, 9 ),
		    array( 2, 10, 14 ),
		    array( 3, 15, 19 ),
		    array( 4, 20, 24 ),
		    array( 5, 21, 24 ),
		    array( 6, 25, 29 ),
		    array( 7, 30, 34 ),
		    array( 8, 35, 39 ),
		    array( 9, 40, 44 ),
		    array( 10, 45, 49 ),
		    array( 11, 50, 54 ),
		    array( 12, 55, 59 ),
		    array( 13, 60, 64 ),
		    array( 14, 65, 69 ),
		    array( 15, 70, 74 ),
		    array( 16, 75, 79 ),
		    array( 17, 80, 84 ),
		    array( 18, 85, 89 ),
		    array( 19, 90, 94 ),
		    array( 20, 95, 99 ),
		    array( 21, 100, 99999 )
	    );

	    $agesM = array( 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 );
	    $agesF = array( 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 );

	    foreach ( $users as $user )
	    {
		    $age = $interval = $user->getBirthdate()->diff( new \DateTime() );
		    foreach ( $categoriesPlace as $c )
		    {
			    if ( $age->y >= $c[1] && $age->y <= $c[2] )
			    {
				    if ( $user->getSex() == 'H' )
				    {
					    $agesM[ $c[0] ] ++;
				    }
				    else
				    {
					    $agesF[ $c[0] ] ++;
				    }
				    break;
			    }
		    }
	    }

	    $ages = array(
		    array(
			    "name" => 'Homme',
			    "data" => $agesM
		    ),
		    array(
			    "name" => "Femme",
			    "data" => $agesF
		    )
	    );

	    return new JsonResponse( $ages );
    }

    /**
     * @Route("/admin/api/departementsPraticien", name="departements-pract")
     */
    public function displayDepartementsPract() {
        $em = $this->getDoctrine()->getManager();
        $practionners = $this->getDoctrine()->getRepository("UserBundle:User")->findByRole('ROLE_PRACTITIONER');


        $zipCodes = [];
        foreach( $practionners as $pract ){
            $dep = substr( $pract->getZipcode() , 0, 2);
            $index = strval($dep);
            if(array_key_exists ($index,$zipCodes)){
                $val = $zipCodes[$index];
                $zipCodes[$index] = $val+1;
            }
            else{
                $zipCodes[$index] = 1;
            }
        }

        $res = [];

        foreach($zipCodes as $dpt => $nb){
            $res[] = ["name" => $dpt , "y" => $nb];
        }



        return new JsonResponse($res);
    }




    /**
     * @Route("/admin/api/departementsMembres", name="departements-membres")
     */
    public function displayDepartementsMembre() {
        $em = $this->getDoctrine()->getManager();
        $practionners = $this->getDoctrine()->getRepository("UserBundle:User")->findByRole('ROLE_MEMBER');


        $zipCodes = [];
        foreach( $practionners as $pract ){
            $dep = substr( $pract->getZipcode() , 0, 2);
            $index = strval($dep);
            if(array_key_exists ($index,$zipCodes)){
                $val = $zipCodes[$index];
                $zipCodes[$index] = $val+1;
            }
            else{
                $zipCodes[$index] = 1;
            }
        }
        $res = [];

        foreach($zipCodes as $dpt => $nb){
            $res[] = ["name" => $dpt , "y" => $nb];
        }



        return new JsonResponse($res);
    }
}