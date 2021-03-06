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


class AdminVideoController extends Controller
{

    /**
     * @Route("/youtube/update", name="youtube_update")
     */
    public function youtubeAction() {


   //    $client = new \Google_Client();
   //    $client->setApplicationName("vimolia Youtube");
   //    $apiKey = "AIzaSyB48Hc9S3A_6sueupj4n14brmH1wb4TUug";

   //    if (strpos($apiKey, "<") !== false) {
   //        echo missingApiKeyWarning();
   //        exit;
   //    }
   //    $client->setDeveloperKey($apiKey);
   //    //$client->setConfig('verify', false);
   //    $service = new \Google_Service_YouTube($client);

   //    $channelsResponse = $service->channels->listChannels('id,contentDetails', array(
   //        'id' => 'UCDg53Em9AHmMlpdlL9j7svw'));


   //    $playlistId = $channelsResponse['items']['contentDetails']['relatedPlaylists']['uploads'];
   //    $searchResponse = $service->playlistItems->listPlaylistItems('snippet', array(
   //        'playlistId' => $playlistId,
   //        'maxResults' => 50,
   //        'fields' => 'items(snippet(publishedAt,channelId,title,description,thumbnails(default),resourceId)),pageInfo,nextPageToken'));
   //    echo json_encode($searchResponse['items']['contentDetails']['videoId']);

   //    $videos = array();
   //    foreach ($searchResponse['items'] as $searchResult) {
   //        switch ($searchResult['id']['kind']) {
   //            case 'youtube#video':
   //                $videos[]= array("title" => $searchResult['snippet']['title'], "video_id" => $searchResult['id']['videoId']);
   //                break;
   //        }
   //    }


   //  #  $em = $this->getDoctrine()->getManager();
   //  #  $em->persist($searchResponse);
   //  #  $em->flush();

   //    return array(
   //        'youtube_videos' => $videos,
   //    );

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

        return $this->render('default/Webtv/displayWebtv.html.twig', array(
            'videos' => $videos
        ));

    }
}