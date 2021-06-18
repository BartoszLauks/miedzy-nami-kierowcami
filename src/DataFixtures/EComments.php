<?php

namespace App\DataFixtures;

use App\Entity\BlogPosts;
use App\Entity\Comments;
use App\Repository\BlogPostsRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EComments extends Fixture
{
    private $blogPosts;
    private $userRepository;
    public function __construct(BlogPostsRepository $blogPosts, UserRepository $userRepository)
    {
        $this->blogPosts = $blogPosts;
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager)
    {
        $commet = new Comments();
        $commet->setText("Komentarz dla postu bez auta");
        $commet->setCreatedAtValue();
        $commet->setPost($this->blogPosts->findOneBy(['title' => 'Post bez auta']));
        $commet->setUser($this->userRepository->findOneBy(['email' => 'bartosz.lauks@interia.pl']));

        $manager->persist($commet);

        $commet = new Comments();
        $commet->setText("Komentarz dla postu z autem");
        $commet->setCreatedAtValue();
        $commet->setPost($this->blogPosts->findOneBy(['title' => 'Post z autem Benznowym']));
        $commet->setUser($this->userRepository->findOneBy(['email' => 'admin@interia.pl']));

        $manager->persist($commet);

        $manager->flush();
    }
}
