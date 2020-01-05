<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personnes", name="personnes")
     */
    public function index(PersonneRepository $personneRepository)
    {
        return $this->render('personne/index.html.twig', [
            'personnes' => $personneRepository->findAll()
        ]);
    }

    /**
     * @Route("/personne/{id}", name="affiche_personne")
     */
    public function affichePersonne(Personne $personne)
    {
        return $this->render('personne/affichePersonne.html.twig', [
            'personne' => $personne
        ]);
    }
}
