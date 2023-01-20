<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetUserController extends AbstractController
{
    #[Route('/get/user', name: 'app_get_user')]
    public function index(UserRepository $userRepository)
    {
        return 'hello';
    }
}
