<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Article;
use App\Entity\BaseData;
use App\Form\CustomerBaseDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ShopController extends AbstractController
{
    
    private $orderMinimumReached;
    private $order;

    /**
     * @Route("/", name="")
     */
    public function index(Request $request)
    {

        $products = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$products) {
            $this->addFlash(
                'notice',
                'Bitte legen sie Produkte an!'
            );
            return $this->redirectToRoute('/createProducts'); // redirects to /root
        }
        $contents = $this->renderView('product/index.html.twig', [
            'products' => $products
        ]);
        return new Response($contents);
    }

    /**
     * @Route("/getorderdata", name="getorderdata")
     */
    public function getOrderData(Request $request)
    {
        // $this->setOrderMinimumReached(0);

        $orderArray = json_decode($request->getContent());

        foreach ($orderArray as $key => $id) {
            $order[$key] = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);
        }
        $this->setOrder($order); // TODO: save order to db-entity (not done yet because of all that corona interruption)
        // unset($order);

        // set order quantity for validation
        $this->setOrderMinimumReached(count($this->getOrder()));
    
        $contents = $this->renderView('shop/shoppingcart.html.twig', [
            'products' => $this->getOrder()
        ]);
    
        return new Response($contents);
    }


    /**
     * @Route("/basedataform", name="basedataform")
     */
    public function baseDataForm(Request $request)
    {
        $customerDataForm = new BaseData();
        $form = $this->createForm(CustomerBaseDataType::class, $customerDataForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->getOrderMinimumReached() === 0) { // backend validation minimum order count
                $this->addFlash(
                    'notice',
                    'Sie muessen mindestens ein Produkt bestellen!'
                );
                return $this->redirectToRoute(''); // redirects to /root
            } else {
                // get form data
                $basedata = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($basedata);
                $entityManager->flush();
                $id = $basedata->getId();

                // loading serializer service
                $encoders = [new CsvEncoder()];
                $normalizers = [new ObjectNormalizer()];
                $serializer = new Serializer($normalizers, $encoders);

                // prepare basedata for csv output
                $serial_data = $serializer->normalize($basedata, null);
                unset($serial_data["birthday"]); // it causes errors in csv file write. TODO fix 
                $parsedArray[] = array_values($serial_data);

                // csv generation
                $csvFilename = "order_id_" . $id;
                $this->outputCSV($parsedArray, false, $csvFilename);
                
                return $this->redirect($this->generateUrl('order_confirmation', array('id' => $id)));
            }           
        }

        return $this->render('shop/basedata.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/orderConfirmation/{id}", name="order_confirmation")
     */
    public function orderConfirmation($id)
    {
        $basedata = $this->getDoctrine()
            ->getRepository(BaseData::class)
            ->find($id);

        $contents = $this->renderView('shop/order-confirm.html.twig', [
            'basedata' => $basedata
        ]);
        return new Response($contents);
    }

    /**
     * 
     */
    public function outputCSV($data, $useKeysForHeaderRow = false, $filename) {
        if ($useKeysForHeaderRow) {
            array_unshift($data, array_keys(reset($data)));
        }
    
        $outputBuffer = fopen("../orders/" . $filename . ".csv", 'w');
        foreach($data as $v) {
            fputcsv($outputBuffer, $v);
        }
        fclose($outputBuffer);
    }
    
    
    /**
     * Get the value of orderMinimumReached
     */ 
    public function getOrderMinimumReached()
    {
        return $this->orderMinimumReached;
    }

    /**
     * Set the value of orderMinimumReached
     *
     * @return  self
     */ 
    public function setOrderMinimumReached($orderMinimumReached)
    {
        $this->orderMinimumReached = $orderMinimumReached;

        return $this;
    }

    /**
     * Get the value of order
     */ 
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set the value of order
     *
     * @return  self
     */ 
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }
}