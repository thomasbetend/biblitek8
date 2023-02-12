<?php

namespace App\Controller;

use App\Entity\PostShare;
use App\Form\PostShareAdminType;
use App\Form\PostShareType;
use App\Repository\PostShareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/postshare')]
class PostShareController extends AbstractController
{
    #[Route('/', name: 'app_post_share_index', methods: ['GET'])]
    public function index(PostShareRepository $postShareRepository): Response
    {
        return $this->render('post_share/index.html.twig', [
            'post_shares' => $postShareRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_post_share_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostShareRepository $postShareRepository): Response
    {
        $postShare = new PostShare();
        $form = $this->createForm(PostShareType::class, $postShare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postShareRepository->save($postShare, true);

            return $this->redirectToRoute('app_post_share_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post_share/new.html.twig', [
            'post_share' => $postShare,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_share_show', methods: ['GET'])]
    public function show(PostShare $postShare): Response
    {
        return $this->render('post_share/show.html.twig', [
            'post_share' => $postShare,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_post_share_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PostShare $postShare, PostShareRepository $postShareRepository): Response
    {
        $form = $this->createForm(PostShareType::class, $postShare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postShareRepository->save($postShare, true);

            return $this->redirectToRoute('app_post_share_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post_share/edit.html.twig', [
            'post_share' => $postShare,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_share_delete', methods: ['POST'])]
    public function delete(Request $request, PostShare $postShare, PostShareRepository $postShareRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postShare->getId(), $request->request->get('_token'))) {
            $postShareRepository->remove($postShare, true);
        }

        return $this->redirectToRoute('app_post_share_index', [], Response::HTTP_SEE_OTHER);
    }
}
