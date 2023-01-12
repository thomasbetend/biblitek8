<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    const USER_THOMAS = 'USER_THOMAS';
    const USER_JEAN = 'USER_JEAN';
    const USER_ADMIN = 'USER_ADMIN';
    const USER_SIMONE = 'USER_SIMONE';

    public function load(ObjectManager $manager): void
    {
        $thomas = new User();
        $thomas->setAvatar('zebre.jpeg');
        $thomas->setEmail('thomas@biblitek.com');
        $thomas->setPseudo('Thom');
        $thomas->setRoles(['ROLE_USER']);
        $thomas->setPassword('$2y$13$6FDKd8Yw46.TtX59V4315uJcVhriO8MkGdmUX8Yloe5H6WWNqH9rq');
        $manager->persist($thomas);
        $this->addReference(self::USER_THOMAS, $thomas);

        $admin = new User();
        $admin->setAvatar('admin.jpeg');
        $admin->setEmail('admin@biblitek.com');
        $admin->setPseudo('Admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword('$2y$13$VPM9HQNWukWZkmwgV.y9KOmGMkI3pgkvMYOHYIq5Nf1wwe1nSqIOG');
        $manager->persist($admin);
        $this->addReference(self::USER_ADMIN, $admin);

        $jean = new User();
        $jean->setAvatar('jean-dujardin.jpeg');
        $jean->setEmail('jean@biblitek.com');
        $jean->setPseudo('Jeannot');
        $jean->setRoles(['ROLE_USER']);
        $jean->setPassword('$2y$13$TWWakA/qHjGRXPX/5BDr/.Jahx8P/OCxV5aZL74jVH0LZwFSMFkmC');
        $manager->persist($jean);
        $this->addReference(self::USER_JEAN, $jean);

        $simone = new User();
        $simone->setAvatar('avatar02.jpeg');
        $simone->setEmail('simone@biblitek.com');
        $simone->setPseudo('Simonette');
        $simone->setRoles(['ROLE_USER']);
        $simone->setPassword('$2y$13$RsnVjCHQJMJdcN1KoBHXPOXiNaa2758zWpIXhzyApKNK0shb64JoS');
        $manager->persist($simone);
        $this->addReference(self::USER_SIMONE, $simone);

        // All passwords : demo

        $manager->flush();
    }

}
