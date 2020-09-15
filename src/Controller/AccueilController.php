<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(ProduitRepository $produitRepository) :Response
    {
        $produits = $produitRepository->findAll();

        foreach ($produits as $produit){

            if ($produit->getConcurrence() !== null)
            if ($produit->getEtat()->getName() === $produit->getConcurrence()->getEtat()){
                if ($produit->getPrice()->getPrixNormal() > $produit->getConcurrence()->getPrix()){
                    $prixNormal = $produit->getConcurrence()->getPrix() - 1;
                }
            }

        }
        return $this->render('accueil/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }
}
