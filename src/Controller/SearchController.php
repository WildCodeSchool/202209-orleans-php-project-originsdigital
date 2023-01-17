<?php

namespace App\Controller;

use App\Form\VideoSearchType;
use App\Repository\VideoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request, VideoRepository $videoRepository): Response
    {
        $form = $this->createForm(VideoSearchType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $videos = $videoRepository->searchVideo($data['search']);
        }  else {
            $videos = null;
        }

        return $this->renderForm('search/index.html.twig', [
            'videos' => $videos,
            'form' => $form,
        ]);
    }
}
