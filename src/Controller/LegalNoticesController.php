<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalNoticesController extends AbstractController
{
    #[Route('/legalnotices', name: 'app_legal')]
    public function index(): Response
    {
        return $this->render('LegalNotices/index.html.twig');
    }
}
