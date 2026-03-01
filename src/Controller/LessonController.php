<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Lesson;
use Doctrine\ORM\EntityManagerInterface;


final class LessonController extends AbstractController
{
    /* #[Route('/lesson', name: 'app_lesson')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/LessonController.php',
        ]);
    } */

    #[Route('/product', name: 'create_product')]
    public function createProduct(EntityManagerInterface $entityManager): Response
    {
        $product = new Lesson();
        $product->setTitle('Keyboard');
        $product->setDuration(40);
        $product->setDescription('Keyboard');


        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

        
    #[Route('/product/{id}', name: 'app_question')]
    public function index(EntityManagerInterface  $entityManager, int $id): Response
    {

    
         $question = $entityManager->getRepository(Lesson::class)->find($id);
        
        if (!$question) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('Check out this great product: ' . $question->getText());
    }
}
