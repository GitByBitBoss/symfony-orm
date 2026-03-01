<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Question;
use App\Entity\Lesson;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Form\QuestionType;

final class QuestionController extends AbstractController
{

 #[Route('/question/new', name: 'app_question_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question = new Question();
            $question->setText($form->get('text')->getData());
            $question->setLesson($form->get('lesson')->getData());

            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('app_question', ['id' => $question->getId()]);
        }

        return $this->render('newQuestion.html.twig', [
            'form' => $form,
        ]);
    }



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
