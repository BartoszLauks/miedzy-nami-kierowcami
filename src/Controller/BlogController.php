<?php

namespace App\Controller;

use App\Entity\BlogPosts;
use App\Entity\Cars;
use App\Entity\Comments;
use App\Form\BlogPostTypeFormType;
use App\Form\CommentFormType;
use App\Repository\BlogPostsRepository;
use App\Repository\CarsRepository;
use App\Repository\CommentsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class BlogController extends AbstractController
{
    private $blogPostsRepository;
    private $commentsRepository;
    private $carsRepository;
    private $userRepository;
    private $security;
    private $entityManager;

    public function __construct(BlogPostsRepository $blogPostsRepository, CommentsRepository $commentsRepository,
                                CarsRepository $carsRepository,UserRepository $userRepository,Security $security, EntityManagerInterface $entityManager)
    {
        $this->blogPostsRepository = $blogPostsRepository;
        $this->commentsRepository = $commentsRepository;
        $this->carsRepository = $carsRepository;
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function index(Request $request): Response
    {
        $posts = $this->blogPostsRepository->findAll();
        //dd($posts);

        $post = new BlogPosts();
        $form = $this->createForm(BlogPostTypeFormType::class,$post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            if ($title = $request->get("blog_post_type_form")["title"])
            {
                $post->setTitle($title);
            }
            if ($text = $request->get("blog_post_type_form")["text"])
            {
                $post->setText($text);
            }

            if ($id = $request->get("blog_post_type_form")["cars"])
            {
                $car = $this->carsRepository->find($id);
                $post->setCars($car);

            } else {
                $post->setCars(null);
            }
            $post->setUser($this->userRepository->find($this->security->getUser()));

            $this->entityManager->persist($post);
            $this->entityManager->flush();

            return $this->redirectToRoute('blog');

        }

        return $this->render( "blog/index.html.twig", [
            'post_form' => $form->createView(),
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/blog/post/{post}", name="show_comments")
     */
    public function show_post(Request $request,BlogPosts $post)
    {
        $comments = $this->commentsRepository->findBy(['post' => $post]);

        $comment = new Comments();
        $form = $this->createForm(CommentFormType::class,$comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            if ($text = $request->get("comment_form")["text"])
            {
                $comment->setText($text);
            }
            $comment->setPost($post);
            $comment->setUser($this->userRepository->find($this->security->getUser()));

            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            return $this->redirectToRoute('show_comments',['post' => $post->getId()]);
            //return $this->render('blog/showComments.html.twig', [
            //    'comment_form' => $form->createView(),
            //    'comments' => $comments,
            //    'post' => $post
            //]);
        }

        //dd($comments);
        return $this->render('blog/showComments.html.twig', [
            'comment_form' => $form->createView(),
            'comments' => $comments,
            'post' => $post
        ]);
    }

    /**
     * @Route("/blog/cars/{car}", name="posts_car")
     */
    public function posts_car(Cars $car)
    {
        $posts = $this->blogPostsRepository->findBy(['cars' => $car]);

        //dd($posts);

        return $this->render('blog/postCar.html.twig', [
            'posts' => $posts
        ]);

    }
}
