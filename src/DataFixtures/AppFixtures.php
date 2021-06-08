<?php

namespace App\DataFixtures;

use App\Entity\Engines;
use App\Entity\EngineTypes;
use App\Entity\News;
use App\Entity\User;
use App\Repository\EngineTypesRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    private $engineTypesRepository;
    private $security;
    private $userRepository;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EngineTypesRepository $engineTypesRepository,
                                Security $security,UserRepository $userRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->engineTypesRepository = $engineTypesRepository;
        $this->security = $security;
        $this->userRepository = $userRepository;
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


        // Tablica EnginesTypes

        $enginestypes = new EngineTypes();
        $enginestypes->setName('Diesel');

        $manager->persist($enginestypes);

        $enginestypes = new EngineTypes();
        $enginestypes->setName('Benzyna');

        $manager->persist($enginestypes);

        // Koniec EnginesTypes

        /*
        // Tablica BodysEngineMarks
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
        // Koniec BodysEngineMarks

        */

        //Wywolanie testu :
        //symfony console doctrine:fixtures:load
        $manager->flush();
    }
}
