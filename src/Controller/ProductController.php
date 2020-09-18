<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/createProduct", name="product")
     */
    public function createProducts(Request $request): Response
    {
         // creates a Product object and initializes some data
         $article = new Article();
         
 
        $form = $this->createFormBuilder($article)
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('weight')
            ->add('artist')
            //->add('category', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Product'])
            ->getForm();
 

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $productData = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($productData);
             $entityManager->flush();

            return new Response('Saved new product with id '.$productData->getId(). '</br><a href="/createProduct"> Neuen Artikel anlegen</a>');
            //$this->redirectToRoute('product');
        }

        return $this->render('shop/products.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
