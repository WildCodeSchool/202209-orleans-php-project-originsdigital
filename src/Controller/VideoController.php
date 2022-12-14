<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    #[Route('/video', name: 'app_video')]
    public function index(): Response
    {
        return $this->render('video/index.html.twig');
    }
}
