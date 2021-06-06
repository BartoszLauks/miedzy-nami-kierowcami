<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsFormType;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    public function __construct(EntityManagerInterface $entityManager, NewsRepository $newsRepository)
    {
        $this->entityManager = $entityManager;
        $this->newsRepository = $newsRepository;
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
            $this->denyAccessUnlessGranted('ROLE_EDITOR');
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
            $this->entityManager->persist($news);
            $this->entityManager->flush();

            return $this->render('home/index.html.twig',[
                'news_form' => $form->createView(),
                'newses' => $getnews,
            ]);
        }

        return $this->render('home/index.html.twig',[
            'news_form' => $form->createView(),
            'newses' => $getnews,
        ]);
    }
}
