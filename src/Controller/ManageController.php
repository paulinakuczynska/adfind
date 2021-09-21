<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManageController extends AbstractController
{
    /**
     * @Route("/manage", name="manage_index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository, TagRepository $tagRepository): Response
    {
        $categories = $categoryRepository->orderByNameAndId();
        $tags = $tagRepository->orderByNameAndId();

        return $this->render('Manage/index.html.twig', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

}