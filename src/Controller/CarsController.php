<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Form\CarsFormType;
use App\Repository\CarBodysRepository;
use App\Repository\CarsRepository;
use App\Repository\EnginesRepository;
use App\Repository\MarksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    private $carsRepository;
    private $marksRepository;
    private $enginesRepository;
    private $carBodysRepository;
    private $entityManager;
    public function __construct(CarsRepository $carsRepository, MarksRepository $marksRepository,
                                EnginesRepository $enginesRepository, CarBodysRepository $carBodysRepository,EntityManagerInterface $entityManager)
    {
        $this->carsRepository = $carsRepository;
        $this->marksRepository = $marksRepository;
        $this->enginesRepository =$enginesRepository;
        $this->carBodysRepository = $carBodysRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/cars", name="cars")
     */
    public function index(Request $request): Response
    {
        $cars = $this->carsRepository->findAll();

        $car = new Cars();
        $form = $this->createForm(CarsFormType::class,$car);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->denyAccessUnlessGranted('ROLE_EDITOR');

            if($name = $request->get('cars_form')['name'])
            {
                $car->setName($name);
            }
            if($mark = $request->get('cars_form')['marks'])
            {
                $car->setMarks($this->marksRepository->find($mark));
            }
            if($engine = $request->get('cars_form')['engines'])
            {
                $car->setEngines($this->enginesRepository->find($engine));
            }
            if($body = $request->get('cars_form')['carBodys'])
            {
                $car->setCarBodys($this->carBodysRepository->find($body));
            }
            $this->entityManager->persist($car);
            $this->entityManager->flush();

            return $this->render('cars/index.html.twig', [
                'cars' => $cars,
                'car_form'  => $form->createView()
            ]);
        }

        return $this->render('cars/index.html.twig', [
            'cars' => $cars,
            'car_form'  => $form->createView()
        ]);
    }

    /**
     * @param Cars $cars
     * @return Response
     * @Route("/cars/{cars}", name="show_car")
     */
    public function show(Cars $cars): Response
    {
        $car = $this->carsRepository->find($cars);
        //$mark = $this->marksRepository->find($car->getMarks());
        $engines = $this->enginesRepository->find($car);
        $body = $this->carBodysRepository->find($car);

        //dd($cars->getCarBodys());
        return $this->render('cars/showCar.html.twig', [
            'car' => $car,
            'mark' => $car->getMarks(),
            'engines' => $car->getEngines(),
            'body' => $car->getCarBodys()
        ]);
    }
}
