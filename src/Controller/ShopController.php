<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Article;
use App\Entity\BaseData;
use App\Form\CustomerBaseDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(Request $request)
    {

    $products = $this->getDoctrine()
        ->getRepository(Article::class)
        ->findAll();

    dump($products);

    if (!$products) {
        throw $this->createNotFoundException(
            'Keine Artikel gefunden! Bitte <a href="/createProduct">neue Artikel anlegen</a>' 
        );
    }

    $contents = $this->renderView('product/index.html.twig', [
        'products' => $products
    ]);

    // An dieser Stelle abgebrochen weil es mir nicht innerhalb der Zeit möglich war das Artikelbestell Formular fertig zu stellen. 
    return new Response($contents);
    }

    /**
     * @Route("/basedata")
     */
    public function basedata(Request $request)
    {
        // creates a BaseData object and initializes some data for this example
        $baseData = new BaseData();

        $form = $this->createForm(CustomerBaseDataType::class, $baseData);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }
       // ...
       return $this->render('shop/basedata.html.twig', [
        'form' => $form->createView(),
    ]);
    }
    
}