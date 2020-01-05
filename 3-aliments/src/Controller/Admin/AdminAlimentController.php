<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAlimentController extends AbstractController
{
    /**
     * @Route("/admin/aliments", name="admin_aliments")
     */
    public function index(AlimentRepository $alimentRepository)
    {
        return $this->render('admin/admin_aliment/adminAliment.html.twig', [
            'aliments' => $alimentRepository->findAll()
        ]);
    }


    /**
     * @Route("/admin/aliment/creation", name="admin_aliment_creation")
     * @Route("/admin/aliment/{id}", name="admin_aliment_modification", methods="GET|POST")
     */
    public function ajoutEtModification(Request $request, Aliment $aliment = null)
    {
        $objectManager = $this->getDoctrine()->getManager();

        if (!$aliment) {
            $aliment = new Aliment();
        }

        $form = $this->createForm(AlimentType::class, $aliment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modif =  $aliment->getId() !== null;
            $objectManager->persist($aliment);
            $objectManager->flush();
            $this->addFlash("success", ($modif) ? "la modification a été effectué" : "l'ajout a été effectué");
            return $this->redirectToRoute("admin_aliments");
        }

        return $this->render('admin/admin_aliment/modifEtAjoutAliment.html.twig', [
            "aliment" => $aliment,
            "form" => $form->createView(),
            "isModification" => $aliment->getId() !== null
        ]);
    }

    /**

     * @Route("/admin/aliment/{id}", name="admin_aliment_suppression", methods="DELETE")
     */
    public function suppression(Aliment $aliment, Request $request, EntityManagerInterface $entityManager)
    {
        if ($this->isCsrfTokenValid("SUP" . $aliment->getId(), $request->get('_token'))) {
            $entityManager->remove($aliment);
            $entityManager->flush();
            $this->addFlash("success", "la suppression a été effectué");
            return $this->redirectToRoute("admin_aliments");
        }
    }
}
