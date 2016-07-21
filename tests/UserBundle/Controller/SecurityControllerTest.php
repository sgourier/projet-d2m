<?php

namespace Tests\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginPage()
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    public function testLoginFail()
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/login');
        
        $form = $crawler->selectButton('_submit')->form();

        // set some values
        $form['_username'] = 'sgourier';
        $form['_password'] = 'test';
        
        // submit the form
        $crawler = $client->submit($form);
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $nbResult = $crawler->filter('.error_message')->count();
        
        $this->assertEquals(1,$nbResult);
    }
    
    public function testLoginSuccess()
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/login');
        
        $form = $crawler->selectButton('_submit')->form();

        // set some values
        $form['_username'] = 'sgourier';
        $form['_password'] = 'tests';
        
        // submit the form
        $crawler = $client->submit($form);
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Deconnexion")')->count()
        );
    }
    
    public function testLogout()
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/login');
        
        $form = $crawler->selectButton('_submit')->form();

        // set some values
        $form['_username'] = 'sgourier';
        $form['_password'] = 'tests';
        
        // submit the form
        $crawler = $client->submit($form);
        
        $logoutLink = $crawler->selectLink('Deconnexion')->link();
        $this->assertEquals(1,count($logoutLink));
        
        $crawler = $client->click($logoutLink);
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Connexion")')->count()
            );
    }
}