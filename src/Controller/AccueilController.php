<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Entana;
use App\Form\EntanaType;
use App\Repository\EntanaRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(SessionInterface $session,EntanaRepository $entanaRepository)
    { $panier=$session->get('panier',[]);$panierWithData=[];
        foreach ($panier as $id => $quantite) {
           $panierWithData[]=['entana' => $entanaRepository->find($id),'quantite' => $quantite]; }
        $totalQuantite = 0;
        foreach ($panierWithData as $item) {$totalQuantite += $item['quantite'];}
        return $this->render('accueil/index.html.twig', ['controller_name' => 'AccueilController','entanas' => $entanaRepository->findAll(),'items' =>  $panierWithData,'totalQuantite'=>  $totalQuantite,
    ]);}}
