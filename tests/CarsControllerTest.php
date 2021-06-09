<?php


namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CarsControllerTest extends WebTestCase
{
    public function testCars(): void
    {
        $client = static::createClient();
        $client->request('GET', '/blog');

        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Auta');
        $this->assertSelectorTextContains('h2', 'Auta');
    }

    public function testMoveToCarSpecifiaction() : void
    {
        $client = static::createClient();
        $client->request('GET', '/blog');

        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Auta');
        $this->assertSelectorTextContains('h2', 'Auta');

        $client->clickLink('Przejdz');

        $this->assertPageTitleContains('Specyfikacja Auta');
        $this->assertSelectorTextContains('h1', 'BMW SERIA 1 E81/E87 HATCHBACK 5D E87 1.6 116I 115KM 85KW 2004-2007');

    }

    public function testMoveToCometsAndAddItViaCarsAndBlog() : void
    {
        $client = static::createClient();
        $client->request('GET', '/blog');

        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Auta');
        $this->assertSelectorTextContains('h2', 'Auta');

        $client->clickLink('Sprawdz');

        $this->assertPageTitleContains('Blog');
        $this->assertSelectorTextContains('h2', 'Post');

        $client->clickLink('Przejdz');

        $this->assertPageTitleContains('Blog');
        $this->assertSelectorTextContains('h2', 'Komentarze');

        $client->submitForm('Submit', [
            'comment_form[text]' => 'test comments'
        ]);
        $this->assertResponseRedirects();
        $client->followRedirect();
    }
}