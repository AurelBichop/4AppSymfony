<?php

namespace App\Controller;

use App\Entity\Continent;
use App\Repository\ContinentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContinentController extends AbstractController
{
    /**
     * @Route("/continents", name="continents")
     */
    public function index(ContinentRepository $continentRepository)
    {
        return $this->render('continent/continents.html.twig', [
            'continents' => $continentRepository->findAll()
        ]);
    }

    /**
     * @Route("/continent/{id}", name="afficher_continent")
     */
    public function afficherContinent(Continent $continent)
    {
        return $this->render('continent/afficherContinent.html.twig', [
            'continent' => $continent
        ]);
    }
}
