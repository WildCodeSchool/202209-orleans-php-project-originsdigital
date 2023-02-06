<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use App\Repository\UserRepository;
use App\Repository\VideoRepository;
use App\Repository\AdvertRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/video/{video}', methods: ['GET'], name: 'app_video_show')]
    public function showVideo(
        Video $video,
        VideoRepository $videoRepository,
        AdvertRepository $advertRepository
    ): Response {
        $ads = $advertRepository->findAll();
        if ($ads != null) {
            $randAds = $ads[array_rand($ads, 1)];
        } else {
            $randAds = [];
        }
        $countViews = $video->getView() + 1;
        $video->setView($countViews);
        $videoRepository->save($video, true);

        return $this->render('video/index.html.twig', [
            'video' => $video,
            'ads' => $randAds,
        ]);
    }

    #[Route('/{id}/favoris', methods: ['POST'], name: 'app_video_favoris')]
    public function addToFavorite(Video $video, UserRepository $userRepository, Request $request): Response
    {

        /** @var \App\Entity\User */
        $user = $this->getUser();

        if ($user->isInFavorite($video)) {
            $user->removeFavorite($video);
        } else {
            $user->addFavorite($video);
        }

        if ($this->isCsrfTokenValid('favorite' . $video->getId(), $request->request->get('_token'))) {
            $userRepository->save($user, true);
        }

        return $this->redirectToRoute('app_video_show', ['video' => $video->getId()], Response::HTTP_SEE_OTHER);
    }

    #[Route('/mes-favoris', name: 'app_favorite_video')]
    public function showFavoriteVideo(): Response
    {
        return $this->render('profile/showFavoriteVideo.html.twig', []);
    }

    #[Route('/like/video/{id}', name: 'app_video_like')]
    public function likeVideo(Video $video, UserRepository $userRepository, Request $request): Response
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();

        if ($video->isLikedByUser($user)) {
            $video->removeLike($user);
        } else {
            $video->addLike($user);
        }

        if ($this->isCsrfTokenValid('likes' . $video->getId(), $request->request->get('_token'))) {
            $userRepository->save($user, true);
        }

        return $this->redirectToRoute('app_video_show', ['video' => $video->getId()], Response::HTTP_SEE_OTHER);
    }
}
