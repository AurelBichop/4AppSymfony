<?php

namespace App\Controller;

use App\Entity\RechercheVoiture;
use App\Form\RechercheVoitureType;
use App\Repository\VoitureRepository;

use Knp\Component\Pager\PaginatorInterface;
use PhpParser\Node\Expr\New_;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class VoitureController extends AbstractController
{
    /**
     * @Route("/client/voitures", name="voitures")
     */
    public function index(VoitureRepository $repo, PaginatorInterface $paginatorInterface, Request $request)
    {

        $rechercheVoitures = new RechercheVoiture();

        $form = $this->createForm(RechercheVoitureType::class, $rechercheVoitures);
        $form->handleRequest($request);

        $voitures = $paginatorInterface->paginate(
            $repo->findAllWithPagination($rechercheVoitures), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('voiture/voitures.html.twig', [
            'voitures' => $voitures,
            'form' => $form->createView(),
            'admin' => false
        ]);
    }
}
