<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    /**
     * @Route("/types", name="types")
     */
    public function index(TypeRepository $typeRepository)
    {
        $types = $typeRepository->findAll();
        return $this->render('type/types.html.twig', [
            'lesTypes' => $types
        ]);
    }
}
