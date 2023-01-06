<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/redirect_admin', name: 'app_redirect_admin')]
    public function redirection(): Response
    {
        $roles = ($this->getUser()->getRoles());
        
        if ($roles[0] === ('ROLE_ADMIN')) {
            return $this->render('admin/index.html.twig', []);
        } else {
            return $this->redirectToRoute('app_home');
        }
    }
}
