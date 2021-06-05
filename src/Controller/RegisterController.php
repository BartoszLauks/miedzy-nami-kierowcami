<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;



    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;

    }

    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request)
    {
        $form =  $this->createFormBuilder()
            ->add('email',)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
            ])
            ->add('register',SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success float-right'
                ]
            ])
            ->getForm();

        $form->handleRequest($request); //TODO : validation

        if ($form->isSubmitted()) {

            $data = $form->getData();

            $user = new User();

            $user->setEmail($data['email']);
            $user->setPassword(
                $this->passwordEncoder->encodePassword($user,$data['password'])
            );
            $user->setRoles([]);
            //$em = $this->entityManager; //$this->getDoctrine()->getManager();

            $this->entityManager->persist($user);
            $this->entityManager->flush();
            //$em->persist($user);
            //$em->flush();

            //$this->addFlash('success', 'Rejestracja się powiodła!');

            //return ['form' => 'registered'];
            return $this->redirect($this->generateUrl('app_login'));

        }

        //return ['form' => $form->createView()];
        return $this->render("register/index.html.twig",[
            'form' => $form->createView()
        ]);
    }
}
