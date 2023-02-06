<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

#[Route('/admin/category')]
class AdminCatController extends AbstractController
{
    #[Route('/', name: 'app_admin_cat_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('admin_cat/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: 'app_admin_cat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoryRepository $categoryRepository, SluggerInterface $slugger): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($category->getName());
            $category->setSlug($slug);

            $categoryRepository->save($category, true);
            $this->addFlash('success', 'La catégorie à bien été ajouté.');

            return $this->redirectToRoute('app_admin_cat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_cat/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/modifier', name: 'app_admin_cat_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Category $category,
        CategoryRepository $categoryRepository,
        SluggerInterface $slugger
    ): Response {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($category->getName());
            $category->setSlug($slug);

            $categoryRepository->save($category, true);
            $this->addFlash('success', 'La catégorie à bien été modifié.');

            return $this->redirectToRoute('app_admin_cat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_cat/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_cat_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_token'))) {
            $categoryRepository->remove($category, true);
            $this->addFlash('success', 'La catégorie à bien été supprimée.');
        }

        return $this->redirectToRoute('app_admin_cat_index', [], Response::HTTP_SEE_OTHER);
    }
}
