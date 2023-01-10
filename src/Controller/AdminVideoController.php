<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/video')]
class AdminVideoController extends AbstractController
{
    #[Route('/', name: 'app_admin_video_index', methods: ['GET'])]
    public function index(VideoRepository $videoRepository): Response
    {
        return $this->render('adminVideo/index.html.twig', [
            'videos' => $videoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_video_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VideoRepository $videoRepository): Response
    {
        /**  @var \App\Entity\Video */
        
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $videoRepository->save($video, true);

            return $this->redirectToRoute('app_admin_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adminVideo/new.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_video_show', methods: ['GET'])]
    public function show(Video $video): Response
    {
        return $this->render('adminVideo/show.html.twig', [
            'video' => $video,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_video_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Video $video, VideoRepository $videoRepository): Response
    {
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $videoRepository->save($video, true);

            return $this->redirectToRoute('app_admin_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adminVideo/edit.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_video_delete', methods: ['POST'])]
    public function delete(Request $request, Video $video, VideoRepository $videoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $video->getId(), $request->request->get('_token'))) {
            $videoRepository->remove($video, true);
        }

        return $this->redirectToRoute('app_adminVideo_index', [], Response::HTTP_SEE_OTHER);
    }
}
