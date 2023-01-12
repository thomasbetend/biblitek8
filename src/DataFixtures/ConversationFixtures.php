<?php

namespace App\DataFixtures;

use App\Entity\Conversation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConversationFixtures extends Fixture
{
    const CONVERSATION_1 = 'CONVERSATION_1';

    public function load(ObjectManager $manager): void
    {
        $conversation1 = new Conversation();
        $manager->persist($conversation1);
        $this->addReference(self::CONVERSATION_1, $conversation1);

        $manager->flush();
    }
}
