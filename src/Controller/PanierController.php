<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(SessionInterface $session, ProductRepository $ProductRepository): Response
    {
        /*
            Creation du panier s'il n'existe pas
        */
        $panier =$session->get('panier',[]);

        /**
         * On parcours les elements du panier
         */
        $lists= [];

        $net_a_payer = 0;

        foreach ($panier as $key => $qte) {
            /**
             * Retrouver le produit via son id ... ici key pour moi
             */

            $findProductById = $ProductRepository->find($key);
            $lists[] =[
                'quantite' => $qte,
                'produit' => $findProductById
            ];

            $net_a_payer += $qte * $findProductById->getPrix();

        }
        
        return $this->render('panier/index.html.twig', [
            'lists' => $lists,
            'net_a_payer' => $net_a_payer
        ]);
    }

    #[Route('/panier/{id}', name: 'app_ajout_panier')]
    public function ajout(SessionInterface $session, Product $product): Response
    {
        /*
            Creation du panier s'il n'existe pas
        */
        $panier =$session->get('panier',[]);
        
        /**
         * Recuperation de l'id du produit dans le panier
         */
        $idProduct = $product->getId();

        //id = 6

        /**
         * Ajout du produit dans le panier s'il n'existe pas sinon on l'incrémente
         */
        empty($panier[$idProduct]) ? $panier[$idProduct] = 1 : $panier[$idProduct]++;

        $session->set('panier',$panier);

        return $this->redirectToRoute('app_panier');
    }

    //Fonction permettant de changer les quantites
    #[Route('/sup/{id}', name: 'app_supprimer_panier')]
    public function supprimer(SessionInterface $session, Product $product): Response
    {
        /*
            Creation du panier s'il n'existe pas
        */
        $panier =$session->get('panier',[]);
        
        /**
         * Recuperation de l'id du produit dans le panier
         */
        $idProduct = $product->getId();

        /**
         * Ajout du produit dans le panier s'il n'existe pas sinon on l'incrémente
         */
        //empty($panier[$idProduct]) ? $panier[$idProduct] = 1 : $panier[$idProduct]++;

        if (!empty($panier[$idProduct])) {
            if ($panier[$idProduct] > 1) {
                $panier[$idProduct] --;
            } else {
                unset($panier[$idProduct]);
            }
        }
        
        $session->set('panier',$panier);

        return $this->redirectToRoute('app_panier');
    }
}