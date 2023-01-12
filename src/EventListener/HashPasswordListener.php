<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsEntityListener(event: Events::prePersist, method: 'hashPassword', entity: User::class)]
class HashPasswordListener
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        
    }

    public function hashPassword(User $user)
    {
        if (!$user->getPlainPassword()){
            return;
        }

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $user->getPlainPassword(),
        );

        $user->setUpdatedAt(new \DateTime());
        // $this->setUpdatedAt(); stof
        $user->setPassword($hashedPassword);

    }
}