<?php

namespace App\Controller;

use App\Entity\Personnage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersonnageController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('personnage/index.html.twig');
    }

    /**
     * @Route("/persos", name="personnages")
     */
    public function persos()
    {

        Personnage::creerPersonnage();

        return $this->render('personnage/persos.html.twig', [
            "players" => Personnage::$personnages
        ]);
    }

    /**
     * @Route("/persos/{nom}", name="afficher_personage")
     */
    public function afficherPersonnage($nom)
    {

        Personnage::creerPersonnage();

        $perso = Personnage::getPersonnageParNom($nom);
        return $this->render('personnage/perso.html.twig', [
            "perso" => $perso
        ]);
    }
}
