<?php

namespace App\Controller;

use App\Entity\LikePost;
use App\Form\LikePostType;
use App\Repository\LikePostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/like/post')]
class LikePostController extends AbstractController
{
    #[Route('/', name: 'app_like_post_index', methods: ['GET'])]
    public function index(LikePostRepository $likePostRepository): Response
    {
        return $this->render('like_post/index.html.twig', [
            'like_posts' => $likePostRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_like_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LikePostRepository $likePostRepository): Response
    {
        $likePost = new LikePost();
        $form = $this->createForm(LikePostType::class, $likePost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $likePostRepository->save($likePost, true);

            return $this->redirectToRoute('app_like_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('like_post/new.html.twig', [
            'like_post' => $likePost,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_like_post_show', methods: ['GET'])]
    public function show(LikePost $likePost): Response
    {
        return $this->render('like_post/show.html.twig', [
            'like_post' => $likePost,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_like_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LikePost $likePost, LikePostRepository $likePostRepository): Response
    {
        $form = $this->createForm(LikePostType::class, $likePost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $likePostRepository->save($likePost, true);

            return $this->redirectToRoute('app_like_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('like_post/edit.html.twig', [
            'like_post' => $likePost,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_like_post_delete', methods: ['POST'])]
    public function delete(Request $request, LikePost $likePost, LikePostRepository $likePostRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$likePost->getId(), $request->request->get('_token'))) {
            $likePostRepository->remove($likePost, true);
        }

        return $this->redirectToRoute('app_like_post_index', [], Response::HTTP_SEE_OTHER);
    }
}
