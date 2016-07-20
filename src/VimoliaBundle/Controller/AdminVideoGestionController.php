<?php
/**
 * Created by PhpStorm.
 * User: Sylvain Gourier
 * Date: 16/05/2016
 * Time: 16:50
 */

namespace VimoliaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use VimoliaBundle\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class AdminVideoGestionController extends Controller
{

    /**
     * @Route("admin/vimolia/video/affich", name="video_affich")
     */
    public function youtubeGestionAction() {

        $api_key = "AIzaSyDzEQH3YSAz-xFzfthnjr__KX1K3pxHi4o";
        $channel_id = "UCDg53Em9AHmMlpdlL9j7svw";

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=$channel_id&maxResults=50&key=$api_key");
        curl_setopt($ch,CURLOPT_HTTPHEADER,array("Accept: application/json","Accept-Language: fr_FR"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        #curl_setopt($ch,CURLOPT_POST, true);
        $response = curl_exec($ch);
       # var_dump($response);
        curl_close($ch);
        $data = json_decode($response);
       # var_dump(get_object_vars($data->items[0]));

        $videos = [];
        foreach($data->items as $video) {
            if(isset(get_object_vars($video->id)['videoId'])) {
            $video_tmp['id'] = get_object_vars($video->id)['videoId'];
            $video_tmp['title'] = get_object_vars($video->snippet)['title'];
            $video_tmp['description'] = get_object_vars($video->snippet)['description'];
            #$video_tmp['thumbnails'] = get_object_vars($video->snippet)['thumbnails'];
            $videos[] = $video_tmp;
            }
        }

        return $this->render('default/Webtv/AdminWebtv.html.twig', array(
            'videos' => $videos
        ));

    }
}