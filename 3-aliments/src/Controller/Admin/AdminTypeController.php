<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTypeController extends AbstractController
{
    /**
     * @Route("/admin/types", name="admin_types")
     */
    public function index(TypeRepository $repo)
    {
        return $this->render('admin/admin_type/adminTypes.html.twig', [
            'types' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/admin/type/creation", name="admin_type_creation")
     * @Route("/admin/type/{id}", name="admin_type_modification", methods="GET|POST")
     */
    public function ajoutEtModification(Request $request, Type $type = null)
    {
        $objectManager = $this->getDoctrine()->getManager();

        if (!$type) {
            $type = new Type();
        }

        $form = $this->createForm(TypeType::class, $type);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modif =  $type->getId() !== null;
            $objectManager->persist($type);
            $objectManager->flush();
            $this->addFlash("success", ($modif) ? "la modification a été effectué" : "l'ajout a été effectué");
            return $this->redirectToRoute("admin_types");
        }

        return $this->render('admin/admin_type/modifEtAjoutType.html.twig', [
            "type" => $type,
            "form" => $form->createView(),
            "isModification" => $type->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/type/{id}", name="admin_type_suppression", methods="DELETE")
     */
    public function suppression(Type $type, Request $request, EntityManagerInterface $entityManager)
    {
        if ($this->isCsrfTokenValid("SUP" . $type->getId(), $request->get('_token'))) {
            $entityManager->remove($type);
            $entityManager->flush();
            $this->addFlash("success", "la suppression a été effectué");
            return $this->redirectToRoute("admin_types");
        }
    }
}
