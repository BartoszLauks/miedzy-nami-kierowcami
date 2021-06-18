<?php

namespace App\DataFixtures;

use App\Entity\BlogPosts;
use App\Repository\CarsRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DBlogPosts extends Fixture
{
    private $carsRepository;
    private $userRepository;

    public function __construct(CarsRepository $carsRepository,UserRepository $userRepository)
    {
        $this->carsRepository = $carsRepository;
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager)
    {
        $blog = new BlogPosts();
        $blog->setTitle("Post z autem Diesel");
        $blog->setText("Post z autem Diesel");
        $blog->setCreatedAtValue();
        $blog->setCars($this->carsRepository->findOneBy(['name' => 'BMW SERIA 1 E81/E87 HATCHBACK 5D E87 2.0 116D 115KM 85KW 2010-2011']));
        $blog->setUser($this->userRepository->findOneBy(['email' => 'bartosz.lauks@interia.pl']));

        $manager->persist($blog);

        $blog = new BlogPosts();
        $blog->setTitle("Post z autem Benznowym");
        $blog->setText("Post z autem Benznowym");
        $blog->setCreatedAtValue();
        $blog->setCars($this->carsRepository->findOneBy(['name' => 'BMW SERIA 1 E81/E87 HATCHBACK 5D E87 1.6 116I 115KM 85KW 2004-2007']));
        $blog->setUser($this->userRepository->findOneBy(['email' => 'bartosz.lauks@interia.pl']));

        $manager->persist($blog);

        $blog = new BlogPosts();
        $blog->setTitle("Post bez auta");
        $blog->setText("Post bez auta");
        $blog->setCreatedAtValue();
        //$blog->setCars($this->carsRepository->findOneBy(['name' => 'BMW SERIA 1 E81/E87 HATCHBACK 5D E87 2.0 116I 115KM 85KW 2010-2011']));
        $blog->setUser($this->userRepository->findOneBy(['email' => 'bartosz.lauks@interia.pl']));

        $manager->persist($blog);

        $manager->flush();
    }
}
