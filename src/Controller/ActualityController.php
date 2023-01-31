<?php

namespace App\Controller;

use App\Entity\Actuality;
use App\Form\ActualityType;
use App\Repository\ActualityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/actuality')]
class ActualityController extends AbstractController
{
    #[Route('/', name: 'app_actuality_index', methods: ['GET'])]
    public function index(ActualityRepository $actualityRepository): Response
    {
        return $this->render('actuality/index.html.twig', [
            'actualities' => $actualityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_actuality_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ActualityRepository $actualityRepository): Response
    {
        $actuality = new Actuality();
        $form = $this->createForm(ActualityType::class, $actuality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actualityRepository->save($actuality, true);
            $this->addFlash('success', 'La bannière a bien été ajoutée');

            return $this->redirectToRoute('app_actuality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('actuality/new.html.twig', [
            'actuality' => $actuality,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_actuality_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Actuality $actuality, ActualityRepository $actualityRepository): Response
    {
        $form = $this->createForm(ActualityType::class, $actuality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actualityRepository->save($actuality, true);

            return $this->redirectToRoute('app_actuality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('actuality/edit.html.twig', [
            'actuality' => $actuality,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_actuality_delete', methods: ['POST'])]
    public function delete(Request $request, Actuality $actuality, ActualityRepository $actualityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $actuality->getId(), $request->request->get('_token'))) {
            $actualityRepository->remove($actuality, true);
        }

        return $this->redirectToRoute('app_actuality_index', [], Response::HTTP_SEE_OTHER);
    }
}
