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

}
