<?php

namespace App\Tests;



use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterControllerTest extends WebTestCase
{


    public function testRegister(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h2', 'Podaj dane do rejestracji');

        $client->submitForm('Register', [
            'form[email]' => 'testn@test.pl',
            'form[password][first]' => '123',
            'form[password][second]' => '123'
            ]);
        //$this->assertResponseRedirects();
        //$client->followRedirect();

        //$client->clickLink('Register');

        //$this->assertSelectorTextContains('h2','Podaj dane do rejestracji');

    }
}
