<?php

namespace App\Controller;

use App\Entity\Famille;
use App\Repository\FamilleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FamilleController extends AbstractController
{
    /**
     * @Route("/familles", name="familles")
     */
    public function index(FamilleRepository $familleRepository)
    {
        $familles = $familleRepository->findAll();

        return $this->render('famille/familles.html.twig', [
            "familles" => $familles
        ]);
    }

    /**
     * @Route("/famille/{id}", name="afficher_famille")
     */
    public function afficherFamille(Famille $famille)
    {
        return $this->render('famille/afficherFamille.html.twig', [
            "famille" => $famille
        ]);
    }
}
