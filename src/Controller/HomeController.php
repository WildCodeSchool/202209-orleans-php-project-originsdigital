<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VideoRepository $videoRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'videos' => $videoRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}
