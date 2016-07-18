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
        $client = new \Google_Client();
        $client->setApplicationName("vimolia Youtube");
        $apiKey = "AIzaSyB48Hc9S3A_6sueupj4n14brmH1wb4TUug";

        if (strpos($apiKey, "<") !== false) {
            echo missingApiKeyWarning();
            exit;
        }
        $client->setDeveloperKey($apiKey);
        $client->setConfig('verify', false);
        $service = new \Google_Service_YouTube($client);

        $channelsResponse = $service->channels->listChannels('id,contentDetails', array(
            'id' => 'UCDg53Em9AHmMlpdlL9j7svw'));


        $playlistId = $channelsResponse['items']['contentDetails']['relatedPlaylists']['uploads'];
        $searchResponse = $service->playlistItems->listPlaylistItems('snippet', array(
            'playlistId' => $playlistId,
            'maxResults' => 50,
            'fields' => 'items(snippet(publishedAt,channelId,title,description,thumbnails(default),resourceId)),pageInfo,nextPageToken'));
        echo json_encode($searchResponse['items']['contentDetails']['videoId']);

        $videos = array();
        foreach ($searchResponse['items'] as $searchResult) {
            switch ($searchResult['id']['kind']) {
                case 'youtube#video':
                    $videos[]= array("title" => $searchResult['snippet']['title'], "video_id" => $searchResult['id']['videoId']);
                    break;
            }
        }


      #  $em = $this->getDoctrine()->getManager();
      #  $em->persist($searchResponse);
      #  $em->flush();

        return array(
            'youtube_videos' => $videos,
        );

       # return new Response('Videos Save'.$videos->getId());
    }
}