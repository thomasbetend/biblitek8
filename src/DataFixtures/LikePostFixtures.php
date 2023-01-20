<?php

namespace App\DataFixtures;

use App\Entity\LikePost;
use App\Entity\PostShare;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LikePostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $like1 = new LikePost();
        $like1->setPostShare($this->getReference(PostShareFixtures::POST1));
        $like1->setUser($this->getReference(UserFixtures::USER_JEAN));
        $like1->setTotal(1);
        $manager->persist($like1);

        $like2 = new LikePost();
        $like2->setPostShare($this->getReference(PostShareFixtures::POST2));
        $like2->setUser($this->getReference(UserFixtures::USER_JEAN));
        $like2->setTotal(1);
        $manager->persist($like2);

        $like3 = new LikePost();
        $like3->setPostShare($this->getReference(PostShareFixtures::POST1));
        $like3->setUser($this->getReference(UserFixtures::USER_SIMONE));
        $like3->setTotal(1);
        $manager->persist($like3);

        $like4 = new LikePost();
        $like4->setPostShare($this->getReference(PostShareFixtures::POST2));
        $like4->setUser($this->getReference(UserFixtures::USER_SIMONE));
        $like4->setTotal(1);
        $manager->persist($like4);

        $like5 = new LikePost();
        $like5->setPostShare($this->getReference(PostShareFixtures::POST1));
        $like5->setUser($this->getReference(UserFixtures::USER_THOMAS));
        $like5->setTotal(1);
        $manager->persist($like5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            PostShareFixtures::class,
            UserFixtures::class,
        ];
    }
}
