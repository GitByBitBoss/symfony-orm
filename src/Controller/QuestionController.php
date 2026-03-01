<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Question;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;


final class QuestionController extends AbstractController
{
    #[Route('/question/{id}', name: 'app_question')]
    public function index(EntityManagerInterface  $entityManager, int $id): Response
    {

        $repo = $entityManager->getRepository(Question::class);
        $question = $repo->find($id);
        
        return $this->render('details.html.twig', [
            'question' => $question,
        ]);

    }
}
