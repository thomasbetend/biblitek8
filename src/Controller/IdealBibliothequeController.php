<?php

namespace App\Controller;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\Entity\IdealBibliotheque;
use App\Form\IdealBibliothequeType;
use App\Repository\IdealBibliothequeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ideal/bibliotheque')]
class IdealBibliothequeController extends AbstractController
{
    #[Route('/', name: 'app_ideal_bibliotheque_index', methods: ['GET'])]
    public function index(IdealBibliothequeRepository $idealBibliothequeRepository): Response
    {
        return $this->render('ideal_bibliotheque/index.html.twig', [
            'ideal_bibliotheques' => $idealBibliothequeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ideal_bibliotheque_new', methods: ['GET', 'POST'])]
    public function new(Request $request, IdealBibliothequeRepository $idealBibliothequeRepository): Response
    {
        $idealBibliotheque = new IdealBibliotheque();
        $form = $this->createForm(IdealBibliothequeType::class, $idealBibliotheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $idealBibliothequeRepository->save($idealBibliotheque, true);

            return $this->redirectToRoute('app_ideal_bibliotheque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ideal_bibliotheque/new.html.twig', [
            'ideal_bibliotheque' => $idealBibliotheque,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ideal_bibliotheque_show', methods: ['GET'])]
    public function show(IdealBibliotheque $idealBibliotheque): Response
    {
        return $this->render('ideal_bibliotheque/show.html.twig', [
            'ideal_bibliotheque' => $idealBibliotheque,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ideal_bibliotheque_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, IdealBibliotheque $idealBibliotheque, IdealBibliothequeRepository $idealBibliothequeRepository): Response
    {
        $form = $this->createForm(IdealBibliothequeType::class, $idealBibliotheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $idealBibliothequeRepository->save($idealBibliotheque, true);

            return $this->redirectToRoute('app_ideal_bibliotheque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ideal_bibliotheque/edit.html.twig', [
            'ideal_bibliotheque' => $idealBibliotheque,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ideal_bibliotheque_delete', methods: ['POST'])]
    public function delete(Request $request, IdealBibliotheque $idealBibliotheque, IdealBibliothequeRepository $idealBibliothequeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$idealBibliotheque->getId(), $request->request->get('_token'))) {
            $idealBibliothequeRepository->remove($idealBibliotheque, true);
        }

        return $this->redirectToRoute('app_ideal_bibliotheque_index', [], Response::HTTP_SEE_OTHER);
    }
}
