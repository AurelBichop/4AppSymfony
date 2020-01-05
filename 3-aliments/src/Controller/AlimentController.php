<?php

namespace App\Controller;

use App\Repository\AlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{
    /**
     * @Route("/", name="aliments")
     */
    public function index(AlimentRepository $alimentRepository)
    {
        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $alimentRepository->findAll(),
            'isCalorie' => false,
            'isGlucide' => false
        ]);
    }

    /**
     * @Route("/aliments/calorie/{calorie}", name="alimentsParCalorie")
     */
    public function alimentMoinsCalorique(AlimentRepository $alimentRepository, $calorie)
    {
        $aliments = $alimentRepository->getAlimentParPropriete('calorie', '<', $calorie);

        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $aliments,
            'isCalorie' => true,
            'isGlucide' => false
        ]);
    }


    /**
     * @Route("/aliments/glucide/{glucide}", name="alimentsParGlucide")
     */
    public function alimentMoinsGlucide(AlimentRepository $alimentRepository, $glucide)
    {
        $aliments = $alimentRepository->getAlimentParPropriete('glucide', '<', $glucide);

        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $aliments,
            'isCalorie' => false,
            'isGlucide' => true
        ]);
    }
}
