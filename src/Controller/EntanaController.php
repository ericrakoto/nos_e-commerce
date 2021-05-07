<?php

namespace App\Controller;

use App\Entity\Entana;
use App\Form\EntanaType;
use App\Repository\EntanaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntanaController extends AbstractController
{
    /**
     * @Route("/entana", name="entana_index", methods={"GET"})
     */
    public function index(EntanaRepository $entanaRepository): Response
    {
        return $this->render('entana/index.html.twig', [
            'entanas' => $entanaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/entana/new", name="entana_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entana = new Entana();
        $form = $this->createForm(EntanaType::class, $entana);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //nampina ligne eto
            $file=$request->files->get('entana')["sary"];
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $uploads_directory=$this->getParameter('uploads_directory');
            $file->move($uploads_directory,$fileName);
            $entana->setSary($fileName);
            //mifarana eto ny fanampiny
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entana);
            $entityManager->flush();

            return $this->redirectToRoute('entana_index');
        }

        return $this->render('entana/new.html.twig', [
            'entana' => $entana,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/entana/{id}", name="entana_show", methods={"GET"})
     */
    public function show(Entana $entana,EntanaRepository $entanaRepository): Response
    {
        return $this->render('entana/show.html.twig', [
            'entana' => $entana,
            'entanas' => $entanaRepository->findAll()
        ]);
    }

    /**
     * @Route("/entana/{id}/edit", name="entana_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Entana $entana): Response
    {
        $form = $this->createForm(EntanaType::class, $entana);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entana_index', [
                'id' => $entana->getId(),
            ]);
        }

        return $this->render('entana/edit.html.twig', [
            'entana' => $entana,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/entana/{id}", name="entana_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Entana $entana): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entana->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entana);
            $entityManager->flush();
            return $this->redirectToRoute('entana_index');
        }
        return $this->render('entana/index.html.twig', [
            'entanas' => $entanaRepository->findAll(),
        ]);
       // return $this->redirectToRoute('entana_index');
    }
}
