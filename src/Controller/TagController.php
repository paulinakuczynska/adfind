<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tag", name="tag_")
 */
class TagController extends ResourceController
{
    public function __construct()
    {
        parent::__construct(Tag::class, TagType::class, 'tag');
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