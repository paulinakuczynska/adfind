<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", name="category_")
 */
class CategoryController extends ResourceController
{
    public function __construct()
    {
        parent::__construct(Category::class, CategoryType::class, 'category');
    }

    /**
     * @Route("/add", name="add", methods={"GET","POST"})
     * @Route("/edit/{id<\d+>}", name="edit", methods={"GET","POST"})
     */
    public function addEdit(Request $request, $id = null): Response
    {
        return parent::addEdit($request, $id);
    }

    /**
     * @Route("/delete/{id<\d+>}", name="delete", methods={"DELETE"})
     */
    public function delete($id, Request $request): Response
    {
        return parent::delete($id, $request);
    }
}