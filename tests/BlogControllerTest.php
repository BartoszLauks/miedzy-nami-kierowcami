<?php


namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogControllerTest extends WebTestCase
{
    public function testBlogAddPost(): void
    {
        $client = static::createClient();
        $client->request('GET', '/blog');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Posts');

        $client->submitForm('Submit', [
            'blog_post_type_form[title]' => 'TestController',
            'blog_post_type_form[text]' => 'TestController'
        ]);
        $this->assertResponseRedirects();
        $client->followRedirect();

    }

    public function testBlogMoveToCars() : void
    {
        $client = static::createClient();
        $client->request('GET', '/blog');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Posts');

        $client->clickLink('Przejdz');

        $this->assertPageTitleContains('Specyfikacja Auta');
        $this->assertSelectorTextContains('h1', 'BMW SERIA 1 E81/E87 HATCHBACK 5D E87 2.0 116D 115KM 85KW 2010-2011');

    }
    public function testBlogMoveToCommentsAndAdd() : void
    {
        $client = static::createClient();
        $client->request('GET', '/blog');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Posts');

        $client->clickLink('Do komentarzy');

        $this->assertPageTitleContains('Blog');
        $this->assertSelectorTextContains('h2', 'Post');

        $client->submitForm('Submit', [
            'comment_form[text]' => 'test comments'
        ]);
        $this->assertResponseRedirects();
        $client->followRedirect();
    }
}