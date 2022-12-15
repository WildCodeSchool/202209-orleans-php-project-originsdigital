<?php

namespace App\Controller;

use App\Entity\Sponsor;
use App\Repository\SponsorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SponsorController extends AbstractController
{
    #[Route('/sponsor', name: 'app_sponsor')]
    public function index(SponsorRepository $sponsorRepository): Response
    {
        return $this->render('components/_sponsor.html.twig', [
            'sponsors' => $sponsorRepository->findAll()
        ]);
    }
}
