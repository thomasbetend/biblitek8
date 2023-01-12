<?php

namespace App\DataFixtures;

use App\Entity\IdealBibliotheque;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class IdealBibliothequeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $idealBiblitekThomas = new IdealBibliotheque();
        $idealBiblitekThomas->setBook1($this->getReference(BookFixtures::BOOK1));
        $idealBiblitekThomas->setBook2($this->getReference(BookFixtures::BOOK9));
        $idealBiblitekThomas->setBook3($this->getReference(BookFixtures::BOOK10));
        $idealBiblitekThomas->setBook4($this->getReference(BookFixtures::BOOK5));
        $idealBiblitekThomas->setBook5($this->getReference(BookFixtures::BOOK12));
        $idealBiblitekThomas->setUser($this->getReference(UserFixtures::USER_THOMAS));
        $manager->persist($idealBiblitekThomas);

        $idealBiblitekSimone = new IdealBibliotheque();
        $idealBiblitekSimone->setBook1($this->getReference(BookFixtures::BOOK2));
        $idealBiblitekSimone->setBook2($this->getReference(BookFixtures::BOOK3));
        $idealBiblitekSimone->setBook3($this->getReference(BookFixtures::BOOK7));
        $idealBiblitekSimone->setBook4($this->getReference(BookFixtures::BOOK6));
        $idealBiblitekSimone->setBook5($this->getReference(BookFixtures::BOOK11));
        $idealBiblitekSimone->setUser($this->getReference(UserFixtures::USER_SIMONE));
        $manager->persist($idealBiblitekSimone);

        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            UserFixtures::class,
            BookFixtures::class,
        ];
    }
}
