<?php


namespace App\Tests;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{

//    public function testLogin() :void // Symfony ver 5.1
//    {
//        $client = static::createClient();
//        $userRepository = static::$container->get(UserRepository::class);
//
//        // retrieve the test user
//        $testUser = $userRepository->findOneBy(['email'=>'admin@interia.pl']);
//
//        // simulate $testUser being logged in
//        $client->loginUser($testUser);
//
//        // test e.g. the profile page
//        $client->request('GET', '/');
//        $this->assertResponseIsSuccessful();
//        $this->assertSelectorTextContains('h2', 'News!');
//    }
}