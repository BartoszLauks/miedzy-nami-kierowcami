<?php

namespace App\DataFixtures;

use App\Entity\BlogPosts;
use App\Entity\Cars;
use App\Repository\CarBodysRepository;
use App\Repository\CarsRepository;
use App\Repository\EnginesRepository;
use App\Repository\MarksRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarsFlush extends Fixture
{
    private $marksRepository;
    private $carBodysRepository;
    private $enginesRepository;
    private $carsRepository;

    public function __construct(MarksRepository $marksRepository,CarBodysRepository $carBodysRepository,
                                EnginesRepository $enginesRepository, CarsRepository $carsRepository)
    {
        $this->marksRepository = $marksRepository;
        $this->carBodysRepository = $carBodysRepository;
        $this->enginesRepository = $enginesRepository;
        $this->carsRepository = $carsRepository;
    }

    public function load(ObjectManager $manager)
    {
        // Tablica CarsFlush
        $cars = new Cars();
        $cars->setName('BMW SERIA 1 E81/E87 HATCHBACK 5D E87 1.6 116I 115KM 85KW 2004-2007');
        $cars->setMarks($this->marksRepository->findOneBy(['name' => 'BMW']));
        $cars->setCarBodys($this->carBodysRepository->findOneBy(['width' => '4356']));
        $cars->setEngines($this->enginesRepository->findOneBy(['name' => '1,6 116d 115 KM']));
        $cars->setCreatedAtValue();

        $manager->persist($cars);

        $cars = new Cars();
        $cars->setName('BMW SERIA 1 E81/E87 HATCHBACK 5D E87 2.0 116D 115KM 85KW 2010-2011');
        $cars->setMarks($this->marksRepository->findOneBy(['name' => 'BMW']));
        $cars->setCarBodys($this->carBodysRepository->findOneBy(['width' => '4356']));
        $cars->setEngines($this->enginesRepository->findOneBy(['name' => '1,6 116i 115 KM']));
        $cars->setCreatedAtValue();

        $manager->persist($cars);

        // Koniec CarsFlush

        $manager->flush();
    }
}
