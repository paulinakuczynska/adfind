<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\File;
use App\Entity\Format;
use App\Entity\Mapformat;
use App\Entity\Maptag;
use App\Entity\Subcategory;
use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;

class EntityTestController extends AbstractController
{
    /**
     * @Route("/entitytest", name="entity_test")
     */

    //    public function addSubcategory()
//    {
//        $category = $this->getDoctrine()
//            ->getRepository(Category::class)
//            ->find(1);
//
//        $subcategory = new Subcategory();
//        $subcategory->setName('ABB');
//        $subcategory->setCategory($category);
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($subcategory);
//        $entityManager->flush();
//
//        return new Response('Subcategory name: ' . $subcategory->getName());
//    }

//    public function addTag()
//    {
//        $tag = new Tag();
//        $tag->setName('tag1');
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($tag);
//        $entityManager->flush();
//
//        return new Response('Tag name: ' . $tag->getName());
//    }

//    public function addFile()
//    {
//        $subcategory = $this->getDoctrine()
//            ->getRepository(Subcategory::class)
//            ->find(1);
//
//        $file = new File();
//        $file->setNameAdd('mynewfile');
//        $file->setNameView('mynewfileview');
//        $file->setNameHash('dsfsdfss');
//        $file->setSubcategory($subcategory);
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($file);
//        $entityManager->flush();
//
//        return new Response('File name: ' . $file->getNameView());
//    }

//    public function addMaptag()
//    {
//        $tag = $this->getDoctrine()
//            ->getRepository(Tag::class)
//            ->find(1);
//
//        $file = $this->getDoctrine()
//            ->getRepository(File::class)
//            ->find(1);
//
//        $maptag = new Maptag();
//        $maptag->setTag($tag);
//        $maptag->setFile($file);
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($maptag);
//        $entityManager->flush();
//
//        return new Response('Maptag ready');
//    }

    public function addMapformat()
    {
        $format = $this->getDoctrine()
            ->getRepository(Format::class)
            ->find(1);

        $file = $this->getDoctrine()
            ->getRepository(File::class)
            ->find(1);

        $mapformat = new Mapformat();
        $mapformat->setFormat($format);
        $mapformat->setFile($file);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($mapformat);
        $entityManager->flush();

        return new Response('Mapformat ready');
    }
}
