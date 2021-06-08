<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsFormType;
use App\Repository\NewsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    /**
     * @var NewsRepository
     */
    private NewsRepository $newsRepository;
    /**
     * @var Security
     */
    private $security;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(EntityManagerInterface $entityManager, NewsRepository $newsRepository,
                                Security $security,UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->newsRepository = $newsRepository;
        $this->security = $security;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/", name="home")
     * @throws Exception
     */
    public function index(Request $request, string $photoDir): Response
    {

        $getnews = $this->newsRepository->findFirst();

        $news = new News();
        $form = $this->createForm(NewsFormType::class, $news);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            //dd($request);
            $this->isGranted(['ROLE_EDITOR','ROLE_ADMIN']);
            //$this->denyAccessUnlessGranted(['ROLE_EDITOR','ROLE_ADMIN']);
            //dd($request->get("news_form")["title"]);
            if ($title = $request->get("news_form")["title"])
            {
                $news->setTitle($title);
            }
            if ($description = $request->get("news_form")["description"])
            {
                $news->setDescription($description);
            }
            if ($link = $request->get("news_form")["link"])
            {
                $news->setLink($link);
            }
            if ($photo = $form['photo']->getData()) {
                //dd($photo);
                $filename = bin2hex(random_bytes(6)).'.'.$photo->guessExtension();
                try {
                    $photo->move($photoDir, $filename);
                } catch (FileException $e) {
                        echo $e->getMessage();
                }
                $news->setPhoto($filename);
            }
            $news->setUser($this->userRepository->find($this->security->getUser()));

            $this->entityManager->persist($news);
            $this->entityManager->flush();

            return $this->redirectToRoute('home');
            //return $this->render('home/index.html.twig',[
            //    'news_form' => $form->createView(),
            //    'newses' => $getnews,
            //]);
        }

        return $this->render('home/index.html.twig',[
            'news_form' => $form->createView(),
            'newses' => $getnews,
        ]);
    }
}
