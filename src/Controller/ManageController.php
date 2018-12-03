<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Tag;
use App\Repository\CategoryRepository;
use App\Repository\TagRepository;
use App\Form\CategoryType;
use App\Form\TagType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ManageController extends AbstractController
{
    /**
     * @Route("/manage", name="manage_index", methods={"GET"})
     */

    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('App\Entity\Category')->findAll();
        $tags = $em->getRepository('App\Entity\Tag')->findAll();

        return $this->render('Manage/index.html.twig', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/manage/{type<(tag|category)>}/add", name="manage_add", methods={"GET","POST"})
     */

    public function add($type, Request $request, TagRepository $tagRepository, CategoryRepository $categoryRepository): Response
    {
        switch ($type) {
            case 'category':
                $category = new Category();
                $form = $this->createForm(CategoryType::class, $category);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($category);
                    $em->flush();

                    return $this->redirectToRoute('manage_index');
                }

                return $this->render('Manage/category_add.html.twig', [
                    'categories' => $categoryRepository->findAll(),
                    'category' => $category,
                    'form' => $form->createView(),
                ]);
                break;

            case 'tag':
                $tag = new Tag();
                $form = $this->createForm(TagType::class, $tag);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($tag);
                    $em->flush();

                    return $this->redirectToRoute('manage_index');
                }

                return $this->render('Manage/tag_add.html.twig', [
                    'tags' => $tagRepository->findAll(),
                    'tag' => $tag,
                    'form' => $form->createView(),
                ]);
                break;
        }

        return new Response();
    }

    /**
     * @Route("/manage/{type<(tag|category)>}/{id<\d+>}/edit", name="manage_edit", methods={"GET","POST"})
     */

    public function edit($type, $id, Request $request, Tag $tag = null, Category $category = null): Response
    {
        $em = $this->getDoctrine()->getManager();

        switch ($type) {
            case 'category':
                $em->getRepository(Category::class)->find($id);
                $form = $this->createForm(CategoryType::class, $category);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $this->getDoctrine()->getManager()->flush();

                    return $this->redirectToRoute('manage_index');
                }

                return $this->render('Manage/category_edit.html.twig', ['category' => $category, 'form' => $form->createView()]);

                break;

            case 'tag':
                $em->getRepository(Tag::class)->find($id);
                $form = $this->createForm(TagType::class, $tag);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $this->getDoctrine()->getManager()->flush();

                    return $this->redirectToRoute('manage_index');
                }
                return $this->render('Manage/tag_edit.html.twig', ['tag' => $tag, 'form' => $form->createView()]);

                break;
        }

        return new Response();

    }

    /**
     * @Route("/manage/{type<(tag|category)>}/{id<\d+>}", name="manage_delete", methods={"DELETE"})
     */

    public function delete($type, $id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        switch ($type) {
            case 'category':
                $type = $em->getRepository(Category::class)->find($id);
                break;
            case 'tag':
                $type = $em->getRepository(Tag::class)->find($id);
                break;
        }

        if (!$type) {

            return new Response('no such object :(');
            /* response to do*/

        } elseif ($this->isCsrfTokenValid('delete' . $type->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($type);
            $em->flush();
        }

        return $this->redirectToRoute('manage_index');

    }

}