<?php

namespace App\Controller;

use App\Entity\Advertisement;
use App\Form\AdvertisementType;
use App\Repository\AdvertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ad')]
class AdController extends AbstractController
{
    #[Route('/', name: 'app_ad_index', methods: ['GET'])]
    public function index(AdvertRepository $advertRepository): Response
    {
        return $this->render('ad/index.html.twig', [
            'advertisements' => $advertRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ad_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AdvertRepository $advertRepository): Response
    {
        $advertisement = new Advertisement();
        $form = $this->createForm(AdvertisementType::class, $advertisement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advertRepository->save($advertisement, true);

            return $this->redirectToRoute('app_ad_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ad/new.html.twig', [
            'advertisement' => $advertisement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ad_show', methods: ['GET'])]
    public function show(Advertisement $advertisement): Response
    {
        return $this->render('ad/show.html.twig', [
            'advertisement' => $advertisement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ad_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Advertisement $advertisement, AdvertRepository $advertRepository): Response
    {
        $form = $this->createForm(AdvertisementType::class, $advertisement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advertRepository->save($advertisement, true);

            return $this->redirectToRoute('app_ad_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ad/edit.html.twig', [
            'advertisement' => $advertisement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ad_delete', methods: ['POST'])]
    public function delete(Request $request, Advertisement $advertisement, AdvertRepository $advertRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$advertisement->getId(), $request->request->get('_token'))) {
            $advertRepository->remove($advertisement, true);
        }

        return $this->redirectToRoute('app_ad_index', [], Response::HTTP_SEE_OTHER);
    }
}
