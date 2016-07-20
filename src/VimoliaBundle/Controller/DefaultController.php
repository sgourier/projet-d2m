<?php

namespace VimoliaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {


        /*******************************************************************************************************************/
        /*                                              VIDEOS                                                             */
        /*******************************************************************************************************************/

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=UCDg53Em9AHmMlpdlL9j7svw&maxResults=8&key=AIzaSyDzEQH3YSAz-xFzfthnjr__KX1K3pxHi4o");
        curl_setopt($ch,CURLOPT_HTTPHEADER,array("Accept: application/json","Accept-Language: fr_FR"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        #curl_setopt($ch,CURLOPT_POST, true);
        $response = curl_exec($ch);
        # var_dump($response);
        curl_close($ch);
        $data = json_decode($response);
        //var_dump(get_object_vars($data->items[0]));

        $videos = [];
        foreach($data->items as $video) {
            if(isset(get_object_vars($video->id)['videoId'])) {
                $video_tmp['id'] = get_object_vars($video->id)['videoId'];
                $video_tmp['title'] = get_object_vars($video->snippet)['title'];
                $video_tmp['description'] = get_object_vars($video->snippet)['description'];
                $thumbnails = get_object_vars($video->snippet)['thumbnails'];

                $video_tmp['thumbnails'] = get_object_vars($thumbnails);
                foreach($video_tmp['thumbnails'] as $key => $value) {
                    $video_tmp['thumbnails'][$key] = get_object_vars($value);
                }
                $videos[] = $video_tmp;
            }
        }



        /*******************************************************************************************************************/
        /*                                              DOMAINES                                                           */
        /*******************************************************************************************************************/

        $em = $this->getDoctrine()->getManager();

        $domaines = $em->getRepository('VimoliaBundle:Practdomains')
            ->findAll();





        /*******************************************************************************************************************/
        /*                                              LAST QUESTION                                                      */
        /*******************************************************************************************************************/


        $lastQuestion = $this->getDoctrine()->getRepository('VimoliaBundle:Discussion')->findOneBy(array('public'=>1),array('dateupd'=>'DESC'));
		if(is_object($lastQuestion))
		{
			$question = $em->getRepository('VimoliaBundle:Message')
			               ->findOneBy(array("idDiscussion" => $lastQuestion->getId(),
			                                 "idOwner" => $lastQuestion->getIdMember(),
			                                 "active" => true
			               ));
			$lastQuestion->setQuestion($question);

			$reponse = $em->getRepository('VimoliaBundle:Message')
			              ->findOneBy(array("idDiscussion" => $lastQuestion->getId(),
			                                "idOwner" => $lastQuestion->getIdExpert(),
			                                "active" => true
			              ));
			$lastQuestion->setReponse($reponse);
		}

        return $this->render('default/index.html.twig', [
            "videos" => $videos,
            "domaines" => $domaines,
            "lastQuestion" => $lastQuestion
        ]);
    }
}
