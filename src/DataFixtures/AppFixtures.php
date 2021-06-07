<?php

namespace App\DataFixtures;

use App\Entity\Engines;
use App\Entity\EngineTypes;
use App\Entity\News;
use App\Entity\User;
use App\Repository\EngineTypesRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    private $engineTypesRepository;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EngineTypesRepository $engineTypesRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->engineTypesRepository = $engineTypesRepository;
    }

    public function load(ObjectManager $manager)
    {
        // Tablica User
        $admin = new User();
        $admin->setEmail('admin@interia.pl');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword($admin,'123'));

        $manager->persist($admin);

        $editor = new User();
        $editor->setEmail('editor@interia.pl');
        $editor->setRoles(['ROLE_EDITOR']);
        $editor->setPassword($this->passwordEncoder->encodePassword($editor,'123'));

        $manager->persist($editor);

        $user = new User();
        $user->setEmail('bartosz.lauks@interia.pl');
        $user->setRoles([]);
        $user->setPassword($this->passwordEncoder->encodePassword($user,'123'));

        $manager->persist($user);
        // Koniec User

        // Tablica News
        for ($i = 1; $i <= 10; $i++)
        {
            $news = new News();
            $news->setTitle("Title ".$i);
            $news->setDescription("Description ".$i);
            $news->setLink('https://www.ujd.edu.pl/');
            $news->setPhoto('source.gif');
            //$news->setPhoto(dirname(__DIR__,2).'/public/source.gif');
            $news->setCreatedAtValue();

            $manager->persist($news);
        }
        // Koniec News

        // Tablica EnginesTypes

        $enginestypes = new EngineTypes();
        $enginestypes->setName('Diesel');

        $manager->persist($enginestypes);

        $enginestypes = new EngineTypes();
        $enginestypes->setName('Benzyna');

        $manager->persist($enginestypes);

        // Koniec EnginesTypes

        /*
        // Tablica Engine
        $engine = new Engines();
        $engine->setName('1,6 116i 115 KM');
        $engine->setDisplacement(2500);
        $engine->setPower(115);
        $engine->setEngineTypes($this->engineTypesRepository->findBy(['name' => 'Benzyna']));

        $manager->persist($engine);

        $engine = new Engines();
        $engine->setName('1,6 116d 115 KM');
        $engine->setDisplacement(2500);
        $engine->setPower(115);
        $engine->setEngineTypes($this->engineTypesRepository->findOnBy(['name' => 'Diesel']));

        $manager->persist($engine);
        // Koniec Engine

        */

        //Wywolanie testu :
        //symfony console doctrine:fixtures:load
        $manager->flush();
    }
}
