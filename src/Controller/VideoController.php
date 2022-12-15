<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VideoController extends AbstractController
{
    #[Route('/video', name: 'app_video')]
    public function index(): Response
    {
        return $this->render('video/index.html.twig');
    }

    #[Route('/{video}', methods: ['GET'], name: 'app_video_show')]
    public function showVideo(Video $video, VideoRepository $videoRepository): Response
    {
        return $this->render('video/index.html.twig', [
            'video' => $video,
        ]);
    }
}
