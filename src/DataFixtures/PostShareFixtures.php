<?php

namespace App\DataFixtures;

use App\Entity\PostShare;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostShareFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $postThomas1 = new PostShare();
        $postThomas1->setUser($this->getReference(UserFixtures::USER_THOMAS));
        $postThomas1->setDescription('Super livre, mon préféré...');
        $postThomas1->setDate(new \DateTime('2023-01-04 13:35:40'));
        $postThomas1->setImage('Les-Freres-Karamazov.jpeg');
        $manager->persist($postThomas1);

        $postThomas2 = new PostShare();
        $postThomas2->setUser($this->getReference(UserFixtures::USER_THOMAS));
        $postThomas2->setDescription('Allez les bleus, cele nous rappelle de bons souvenirs...');
        $postThomas2->setDate(new \DateTime('2023-01-04 14:35:40'));
        $postThomas2->setImage('histoire-des-bleus.jpeg');
        $manager->persist($postThomas2);

        $postSimone1 = new PostShare();
        $postSimone1->setUser($this->getReference(UserFixtures::USER_SIMONE));
        $postSimone1->setDescription('De l\'émotion brute, un livre poignant');
        $postSimone1->setDate(new \DateTime('2022-08-07 14:22:00'));
        $postSimone1->setImage('L-Arabe-du-futur-volume-5.jpeg');
        $manager->persist($postSimone1);

        $postSimone2 = new PostShare();
        $postSimone2->setUser($this->getReference(UserFixtures::USER_SIMONE));
        $postSimone2->setDescription('Superbement illustré !');
        $postSimone2->setDate(new \DateTime('2022-12-12 15:01:20'));
        $postSimone2->setImage('kama_sutra.jpeg');
        $manager->persist($postSimone2);

        $postJean1 = new PostShare();
        $postJean1->setUser($this->getReference(UserFixtures::USER_JEAN));
        $postJean1->setDescription('Très très instructif');
        $postJean1->setDate(new \DateTime('2021-08-07 14:22:00'));
        $postJean1->setImage('culture_map.jpeg');
        $manager->persist($postJean1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            UserFixtures::class,
        ];
    }
}
