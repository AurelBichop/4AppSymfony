<?php

namespace App\Controller;

use App\Entity\Arme;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArmeController extends AbstractController
{
    /**
     * @Route("/armes", name="armes")
     */
    public function index()
    {
        Arme::creerArmes();

        return $this->render('arme/armes.html.twig', [
            'armes' => Arme::$armes
        ]);
    }

    /**
     * @Route("/armes/{nom}", name="afficher_arme")
     */
    public function afficherArme($nom)
    {
        Arme::creerArmes();

        $arme = Arme::recupArme($nom);

        return $this->render('arme/arme.html.twig', [
            'arme' => $arme
        ]);
    }
}
