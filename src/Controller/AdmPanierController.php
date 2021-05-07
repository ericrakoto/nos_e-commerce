<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entana;
use App\Form\EntanaType;
use App\Repository\EntanaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Panier;
use App\Repository\PanierRepository;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\QuantiteVendu;
use App\Repository\QuantiteVenduRepository;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Validator\Constraints\DateTime;

class AdmPanierController extends AbstractController
{
    /**
     * @Route("/adm/panier", name="adm_panier")
     */
 
    public function index( SessionInterface $session, EntanaRepository $entanaRepository )
    {
        $panier=$session->get('panier',[]);$p=[];
        foreach ($panier as $id => $quantite) {$p[]=['entana' => $entanaRepository->find($id),'quantite' => $quantite ];}

        $total = 0;
        $totalQuantite = 0;
        foreach ($p as $item) {
           $totalItem = $item['entana']->getVidiny()* $item['quantite'];$totalQuantite += $item['quantite']; $total += $totalItem; }
         return $this->render('panier/panier.html.twig', ['controller_name' => 'AdmPanierController','items' =>  $p,'totalQuantite'=>  $totalQuantite,'total' =>  $total
        ]);}
    /**
     * @Route("/adm/panier/add/{id}", name="adm_panier_gestion")
     */
    public function add($id, SessionInterface $session)
    {
    	$panier = $session->get('panier',[]);
    	if(!empty($panier[$id])){$panier[$id]++;}
    	else{$panier[$id]=1;}
    	$session->set('panier',$panier);
        return $this->redirectToRoute('adm_panier'); //mamerina ilay code etsy ambony
    }
    /**
     * @Route("/adm/panier/decrement/{id}", name="adm_panier_del")
     */
    public function decrement($id, SessionInterface $session, EntanaRepository $entanaRepository)
    {
    	$panier = $session->get('panier',[]);
    	if(!empty($panier[$id])){$panier[$id]--;}
    	else{$panier[$id]=1;}
    	$session->set('panier',$panier);
    	return $this->redirectToRoute('adm_panier'); 

    }
	/**
     * @Route("/adm/panier/delTotal/{id}", name="adm_panier_delTotal")
     */
    public function delTotal($id, SessionInterface $session, EntanaRepository $entanaRepository)
    {

    	$panier = $session->get('panier',[]);
    	if(!empty($panier[$id])){unset($panier[$id]);}
    	else{$panier[$id]=1;}
    	$session->set('panier',$panier);
    	return $this->redirectToRoute('adm_panier'); 
    }

    /**
     * @Route("/adm/panier/payer", name="adm_payer")
     */

    public function payer( Request $request, SessionInterface $session, EntanaRepository $entanaRepository, PanierRepository $panierRepository, UserRepository $userRepository,UserInterface $userInterface, EntityManagerInterface $em,CategoryRepository $categ)
    {
        $panier=$session->get('panier',[]);$p=[];
        foreach ($panier as $id => $quantite) {
           $p[]=['entana' => $entanaRepository->find($id),'quantite' => $quantite ];}

        $total = 0;$totalQuantite = 0;
        foreach ($p as $item) {
           $totalItem = $item['entana']->getVidiny()* $item['quantite'];
           $totalQuantite += $item['quantite']; //nampina quantite
           $total += $totalItem; 
        }
        $date = new \DateTime();

		$ponier = new Panier();
        $entityManager = $this->getDoctrine()->getManager();
       
        $ponier->setUser($userInterface); $ponier->setTotal($total);$entityManager->persist($ponier); $entityManager->flush();$taille = sizeof($p);
        for ($i=0; $i <$taille ; $i++) { 
            if ($p[$i]) {
                $quantiteVendu = new QuantiteVendu();
                   $entityManager = $this->getDoctrine()->getManager();
                   $entana = $entanaRepository->find($p [$i]["entana"]->getId()); 
                   $entana->setQuantiteVendu($p [$i]["quantite"]);
                   $entityManager->persist($entana);
                   $quantiteVendu->setQuantite($entana);
                   $quantiteVendu->setDate($date);
                   $quantiteVendu->setCategory($p [$i]["entana"]->getCategory());
                   $entityManager->persist($quantiteVendu);
                    $entityManager->flush();}}

         return $this->render('panier/panier.html.twig', ['controller_name' => 'AdmPanierController','items' =>  $p,'totalQuantite'=>  $totalQuantite,'total' =>  $total]);}}
