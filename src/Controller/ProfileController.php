<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    #[Route('/profil', name: 'app_profile')]
    public function index(
    ): Response
    {
        $user = $this->getUser();

        return $this->render('profile/index.html.twig', [
            'user'=> $user
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/profil/edit', name: 'user_edit', methods: ['GET', 'POST'])]
    public function editUser(
        Request $request,
        UserRepository $userRepository,
    ): Response {
        /**  @var \App\Entity\User */
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            $this->addFlash(
                'success',
                'Le profil a été mis à jour.'
            );

            return $this->redirectToRoute('app_profile');
        } else {
            $this->addFlash(
                'warning',
                'Les informations saisies sont incorrectes.'
            );
        }

        return $this->renderForm('profile/edit.html.twig', [
            'form' => $form,
            'user' => $user
        ]);
    }
}
