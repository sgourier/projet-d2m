<?php

namespace Tests\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegistrationPage()
    {
        $client = static::createClient();
        $client->followRedirects();
        
        $crawler = $client->request('GET', '/register');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    public function testRegistrationUser()
    {
        $client = static::createClient();
        $client->followRedirects();
        
        $crawler = $client->request('GET','/register');
        
        $form = $crawler->selectButton('Créer un compte')->form();

        // set some values
        $form['fos_user_registration_form[email]'] = uniqid().'@test.fr';
        $form['fos_user_registration_form[username]'] = uniqid();
        $form['fos_user_registration_form[plainPassword][first]'] = 'test';
        $form['fos_user_registration_form[plainPassword][second]'] = 'test';
        $form['fos_user_registration_form[name]'] = 'test';
        $form['fos_user_registration_form[firstname]'] = 'test';
        $form['fos_user_registration_form[address]'] = 'test';
        $form['fos_user_registration_form[zipCode]'] = 'test';
        $form['fos_user_registration_form[city]'] = 'test';
        //$form['fos_user_registration_form[roles][]']->select('utilisateur');
        
        // submit the form
        $crawler = $client->submit($form);
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Un e-mail a été envoyé")')->count()
        );
    }
}