<?php

namespace App\Controller;

use App\Entity\PostLike2;
use App\Form\PostLike2Type;
use App\Repository\PostLike2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post/like2')]
class PostLike2Controller extends AbstractController
{
    #[Route('/', name: 'app_post_like2_index', methods: ['GET'])]
    public function index(PostLike2Repository $postLike2Repository): Response
    {
        return $this->render('post_like2/index.html.twig', [
            'post_like2s' => $postLike2Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_post_like2_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostLike2Repository $postLike2Repository): Response
    {
        $postLike2 = new PostLike2();
        $form = $this->createForm(PostLike2Type::class, $postLike2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postLike2Repository->save($postLike2, true);

            return $this->redirectToRoute('app_post_like2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post_like2/new.html.twig', [
            'post_like2' => $postLike2,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_like2_show', methods: ['GET'])]
    public function show(PostLike2 $postLike2): Response
    {
        return $this->render('post_like2/show.html.twig', [
            'post_like2' => $postLike2,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_post_like2_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PostLike2 $postLike2, PostLike2Repository $postLike2Repository): Response
    {
        $form = $this->createForm(PostLike2Type::class, $postLike2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postLike2Repository->save($postLike2, true);

            return $this->redirectToRoute('app_post_like2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post_like2/edit.html.twig', [
            'post_like2' => $postLike2,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_like2_delete', methods: ['POST'])]
    public function delete(Request $request, PostLike2 $postLike2, PostLike2Repository $postLike2Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postLike2->getId(), $request->request->get('_token'))) {
            $postLike2Repository->remove($postLike2, true);
        }

        return $this->redirectToRoute('app_post_like2_index', [], Response::HTTP_SEE_OTHER);
    }
}
