<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\String\Slugger\SluggerInterface;

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

    #[Route('/{slug}', methods: ['GET'], name: 'show')]
    #[ParamConverter('category', options: ['mapping' => ['slug' => 'slug']])]
    public function show(Category $category): Response
    {
        $video = $category->getVideo();

        return $this->render(
            'category/show.html.twig',
            [
                'category' => $category,
                'videos' => $video,
            ]
        );
    }
}
