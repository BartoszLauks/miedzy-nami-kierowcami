<?php

namespace App\DataFixtures;

use App\Entity\CarBodys;
use App\Entity\Engines;
use App\Entity\Marks;
use App\Entity\News;
use App\Repository\EngineTypesRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BodysEngineMarks extends Fixture
{
    private $engineTypesRepository;
    private $userRepository;

    public function __construct(EngineTypesRepository $engineTypesRepository, UserRepository $userRepository)
    {
        $this->engineTypesRepository = $engineTypesRepository;
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager)
    {
        // Tablica News
        for ($i = 1; $i <= 10; $i++)
        {
            $news = new News();
            $news->setTitle("Title ".$i);
            $news->setDescription("Description ".$i);
            $news->setLink('https://www.ujd.edu.pl/');
            $news->setPhoto('source.gif'); // wstaw testowe zdjecie w /public/uploads/photos/
            $news->setUser($this->userRepository->findOneBy(['email' => 'editor@interia.pl']));
            //$news->setPhoto(dirname(__DIR__,2).'/public/source.gif');
            $news->setCreatedAtValue();

            $manager->persist($news);
        }
        // Koniec News

        // Tablica BodysEngineMarks
        $engine = new Engines();
        $engine->setName('1,6 116i 115 KM');
        $engine->setDisplacement(2500);
        $engine->setPower(115);
        $engine->setEngineTypes($this->engineTypesRepository->findOneBy(['name' => 'Benzyna']));

        $manager->persist($engine);

        $engine = new Engines();
        $engine->setName('1,6 116d 115 KM');
        $engine->setDisplacement(2500);
        $engine->setPower(115);
        $engine->setEngineTypes($this->engineTypesRepository->findOneBy(['name' => 'Diesel']));

        $manager->persist($engine);
        // Koniec BodysEngineMarks

        //Tablica CarBodys
        $carbodys = new CarBodys();
        $carbodys->setHeight(1357);
        $carbodys->setWidth(4356);

        $manager->persist($carbodys);

        //Koniec CarBodys

        // Tablica Marks
        $marks = new Marks();
        $marks->setName('BMW');

        $manager->persist($marks);

        $marks = new Marks();
        $marks->setName('AUDI');

        $manager->persist($marks);

        $marks = new Marks();
        $marks->setName('FIAT');

        $manager->persist($marks);

        // Koniec Marks

        //

        //Wywolanie testu :
        //symfony console doctrine:fixtures:load

        $manager->flush();
    }
}
