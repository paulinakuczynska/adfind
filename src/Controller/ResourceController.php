<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

abstract class ResourceController extends AbstractController
{
    /**
     * @var string
     */
    private $className;

    /**
     * @var string
     */
    private $formClass;

    /**
     * @var string
     */
    private $templateName;

    /**
     * @param string $className
     * @param string $formClass
     * @param string $templateName
     */
    public function __construct(string $className, string $formClass, string $templateName = null)
    {
        $this->className = $className;
        $this->formClass = $formClass;
        $this->templateName = $templateName;
    }

    /**
     * @Route("/add", name="add", methods={"GET","POST"})
     * @Route("/edit/{id<\d+>}", name="edit", methods={"GET","POST"})
     */
    public function addEdit(Request $request, $id = null): Response
    {
        $em = $this->getDoctrine()->getManager();

        if ($id === null) {
            $type = 'add';
            $model = new $this->className;
        } else {
            $type = 'edit';
            $model = $em->getRepository($this->className)->find($id);
            if ($model === null) {
                $this->addFlash('error','Such ' . $this->templateName . ' does not exist.');

                return $this->redirectToRoute('manage_index');
            }
        }

        $form = $this->createForm($this->formClass, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();

            if ($type === 'add') {
                $this->addFlash('notice', 'The ' . $this->templateName . ' has been added.');
            } elseif ($type === 'edit') {
                $this->addFlash('notice','Your changes were saved.');
            }

            return $this->redirectToRoute('manage_index');
        }

        return $this->render($this->getTemplatePath($type), [
            'model' => $model,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id<\d+>}", name="delete", methods={"DELETE"})
     */
    public function delete($id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository($this->className)->find($id);

        if (!$model) {
            $this->addFlash('error','Such ' . $this->templateName . ' does not exist.');

            return $this->redirectToRoute('manage_index');

        } elseif ($this->isCsrfTokenValid('delete' . $model->getId(), $request->request->get('_token'))) {
            $em->remove($model);
            $em->flush();
        }

        $this->addFlash('notice','The ' . $this->templateName . ' has been removed.');

        return $this->redirectToRoute('manage_index');
    }

    /**
     * @param string $action
     * @return string
     */
    private function getTemplatePath(string $action): string
    {
        if ($this->templateName === null) {
            return 'Manage/' . $action . '.html.twig';
        }

        return 'Manage/' . $this->templateName . '_' . $action . '.html.twig';
    }
}