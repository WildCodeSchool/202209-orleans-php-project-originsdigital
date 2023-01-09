<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VideoRepository $videoRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'videos' => $videoRepository->findAll(),
        ]);
    }

    #[Route('/mentions-legales', name: 'app_legal')]
    public function legal(): Response
    {
        return $this->render('LegalNotices/index.html.twig');
    }
}
