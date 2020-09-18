<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\BaseData;
use App\Form\CustomerBaseDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
       // creates a BaseData object and initializes some data for this example
       $baseData = new BaseData();

       $form = $this->createForm(CustomerBaseDataType::class, $baseData);
       // ...
       return $this->render('shop/basedata.html.twig', [
        'form' => $form->createView(),
    ]);
    }
}