<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Form\EntanaType;
use App\Repository\EntanaRepository;
use App\Repository\PanierRepository;
use App\Entity\QuantiteVendu;
use App\Repository\QuantiteVenduRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Entana;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(CategoryRepository $category, QuantiteVenduRepository $quantite, EntanaRepository $entana,UserRepository $userRepository,UserInterface $userInterface,PanierRepository $pan)
    {

        $categNom=[];
        $categCouleur=[];
        $categQuant=[];
        $categories = $category->findAll();
        $entanaVendu = $entana->findEntanaVendu();
        $user = $userRepository->findCountUser();
        $panUser = $pan->findMpividy();
        $panUsan= $panUser[1];
        $entanNom=[];
        $entanTot=[];
        $usany =$user[0][1];
        $entKo=[];

        foreach ($entanaVendu as $item) {
            $entanNom[] = $item['titre_produit'];
            $entanTot[] = $item['vidiny']*$item['QuantiteVendu'];
            $entKo[] = $item['QuantiteVendu'];
        }

        $totEntanaVen = array_sum($entanTot);
        $totEntanaQua = array_sum($entKo);

        foreach ($categories as $catVend) {
            $uncat = $entana->findQuantiteByCategoryAll($catVend->getId());
            $catV[]=[
                'categorie'=> $catVend->getCategory(),
                'quantite' => $uncat[0][1],
                'couleur'=>$catVend->getCouleur()
                           ];
        }
        foreach ($catV as $item) {
            $categNom[] = $item['categorie'];
            $categCouleur[] = $item['couleur'];
            $categQuant[] = $item['quantite'];
        }
        $entityManager = $this->getDoctrine()->getManager();
        
        $usors = $userRepository->findAll();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'categNom'=> json_encode($categNom),
            'categCouleur'=>json_encode($categCouleur),
            'categQuant'=>json_encode($categQuant),
            'users' => $usors,
            'entanaVendus' =>$entanaVendu,
            'revenu' =>$totEntanaVen,
            'usany' =>$usany,
            'countProduit' => $totEntanaQua,
            'mpivid' =>$panUsan
        ]);
    }

    /**
     * @Route("/admin/stats", name="admin_stats")
     */
    public function stats(CategoryRepository $category, QuantiteVenduRepository $quantite, EntanaRepository $entana)
    {
//OK
        $categNom=[];
        $categCouleur=[];
        $categQuant=[];
        $categories = $category->findAll();
        $quantites = $quantite->findAll();
        $entanas = $entana->findAll();


        $entanVidiny=[];
        $entDate=[];
        $date =[];

        $unDate = $quantite->findDateVendu(); //afk tam tableau anaty tableau

foreach ($unDate as $keyDate) {
    $date[] = $keyDate['Date'];
    $entDate[] = $keyDate['count'];
}



        foreach ($categories as $catVend) {
            $uncat = $entana->findQuantiteByCategoryAll($catVend->getId());
            $catV[]=[
                'categorie'=> $catVend->getCategory(),
                'quantite' => $uncat[0][1],
                'couleur'=>$catVend->getCouleur()
                           ];
        }


        foreach ($catV as $item) {
            $categNom[] = $item['categorie'];
            $categCouleur[] = $item['couleur'];
            $categQuant[] = $item['quantite'];
        }

        return $this->render('admin/stats.html.twig', [
            'controller_name' => 'AdminController',
            'categNom'=> json_encode($categNom),
            'categCouleur'=>json_encode($categCouleur),
            'categQuant'=>json_encode($categQuant),

            'entQuant'=>json_encode($entDate),
            'date'=>json_encode($date),
        ]);
    }

}
