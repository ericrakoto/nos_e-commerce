<?php

namespace App\Controller;

use App\Entity\Entana;
use App\Form\EntanaType;
use App\Repository\EntanaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;


class PanierController extends AbstractController

{
    /*private $urlGenerator;*/
    /**
     * @Route("/panier", name="panier")
     */

    public function index( SessionInterface $session, EntanaRepository $entanaRepository ):Response
    {
        //$session = $request->getSession();
        $panier=$session->get('panier',[]);
        $panierWithData=[];

        foreach ($panier as $id => $quantite) {
           $panierWithData[]=[
                'entana' => $entanaRepository->find($id),
                'quantite' => $quantite
                            ];
        }
        //dd($panierWithData);
        $total = 0;
        $totalQuantite = 0;
        foreach ($panierWithData as $item) {
           $totalItem = $item['entana']->getVidiny()* $item['quantite'];
           $totalQuantite += $item['quantite']; //nampina quantite
           $total += $totalItem;
        }
         return $this->json([
            'code' => 200,
            'message' => 'voavidy',
            'totalQuantite'=>  $totalQuantite
        ],200);

    }

    /**
     * @Route("/panier/add/{id}", name="panier_gestion")
     */
    public function add($id, SessionInterface $session)
    {

    	$panier = $session->get('panier',[]);
    	if(!empty($panier[$id])){
    		$panier[$id]++;
    	}
    	else{$panier[$id]=1;}
    	$session->set('panier',$panier);

        return $this->redirectToRoute('panier'); //mamerina ilay code etsy ambony
    }

}
