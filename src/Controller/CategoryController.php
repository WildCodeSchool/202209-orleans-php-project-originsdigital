<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\VideoRepository;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findBy(
            [],
            ['name' => 'ASC'],
        );
        return $this->render(
            'category/index.html.twig',
            [
                'categories' => $categories,
            ]
        );
    }

    #[Route('/{category}', methods: ['GET'], name: 'show')]
    public function show(
        Category $category,
        CategoryRepository $categoryRepository,
        VideoRepository $videoRepository
    ): Response {
        $category = $categoryRepository->findOneBy(['name' => $category]);
        $video = $videoRepository->findby(['category' => $category->getId()]);

        return $this->render(
            'category/show.html.twig',
            [
                'name' => $category,
                'video' => $video,
            ]
        );
    }
}
