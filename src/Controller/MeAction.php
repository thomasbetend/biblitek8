<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpKernel\Attribute\AsController;


#[AsController]
class MeAction extends AbstractController 
{
    public function __invoke(Security $security): User
    {
        return $security->getUser();
    }
}