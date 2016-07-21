<?php

namespace Tests\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PractitionerControllerTest extends WebTestCase
{
    public function testShowProPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/proPage/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('SIRET', $crawler->filter('.container-pract-profile')->text());
    }
    
    public function testShowProList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/proList');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Tous nos praticiens', $crawler->filter('.title')->text());
    }
}