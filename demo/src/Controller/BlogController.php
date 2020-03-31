<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Articlo;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ArticloType;
use App\Repository\ArticloRepository;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticloRepository $repo)
    {
        $articles = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }
    /**
     * @Route("/",name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig',[
            'title' => "bienvenu ici mes amis",
            'age' => 18
        ]);
    }
    /**
     * @Route("/blog/new",name="blog_create")
     * @Route("/blog/{id}/edit",name="blog_edit")
     */
    public function form(Articlo $article = null, Request $request,EntityManagerInterface $manager){ //create et update
       /* dump($request);
        if($request->request->count() >0 ){
            $article = new Articlo();
            $article->setTitle($request->request->get('title'))
                    ->setContent($request->request->get('content'))
                    ->setImage($request->request->get('image'))
                    ->setCreatedAt(new \DateTime());
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('blog_show',['id' => $article->getId()]);
        }
        */
       
       /* $form = $this->createFormBuilder($article)
                    ->add('title',TextType::class,['attr' =>['placeholder'=> "Titre de l'article",
                                                                'class' =>'form-control']])
                    ->add('content',TextareaType::class,['attr' =>['placeholder'=> "contenu de l'article",
                    'class' =>'form-control']])
                    ->add('image',TextType::class,['attr' =>['placeholder'=> "image de l'article",
                    'class' =>'form-control']])
                    ->getForm();*/
                    //methode 2
                    /*$form = $this->createFormBuilder($article)
                    ->add('title',TextType::class,['attr' =>['placeholder'=> "Titre de l'article"]])
                    ->add('content',TextareaType::class,['attr' =>['placeholder'=> "contenu de l'article"]])
                    ->add('image',TextType::class,['attr' =>['placeholder'=> "image de l'article"]])
                    ->getForm();
                    */
                    if(!$article){
                        $article = new Articlo();
                    }
                   /* $form = $this->createFormBuilder($article)
                    ->add('title')
                    ->add('content')
                    ->add('image')
                    ->getForm();
                    */
                    $form = $this->createForm(ArticloType::class,$article);
                    $form->handleRequest($request);
                   // dump($article);
                   if($form->isSubmitted() && $form->isValid()){
                       if(!$article->getId()){
                        $article->setCreatedAt(new \DateTime());
                       }
                       $manager->persist($article);
                       $manager->flush();
                       return $this->redirectToRoute('blog_show',['id' => $article->getId()]);
                   }
        return $this->render('blog/create.html.twig',['formArticle' => $form->createView(),
                                                        'editMode' => $article->getId() !== null]);
    }

    /**
     * @Route("/blog/{id}",name="blog_show")
     */
    public function show(Articlo $article)
    {// $repo = $this->getDoctrine()->getRepository(Articlo::class);
       // $article = $repo->find($id);
        return $this->render('blog/show.html.twig',[
            'article'=> $article
        ]);
    }
    

}
