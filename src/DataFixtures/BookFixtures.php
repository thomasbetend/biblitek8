<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    const BOOK1 = 'BOOK1';
    const BOOK2 = 'BOOK2';
    const BOOK3 = 'BOOK3';
    const BOOK4 = 'BOOK4';
    const BOOK5 = 'BOOK5';
    const BOOK6 = 'BOOK6';
    const BOOK7 = 'BOOK7';
    const BOOK8 = 'BOOK8';
    const BOOK9 = 'BOOK9';
    const BOOK10 = 'BOOK10';
    const BOOK11 = 'BOOK11';
    const BOOK12 = 'BOOK12';

    public function load(ObjectManager $manager): void
    {
        $book1 = new Book();
        $book1->setName('Pour qui sonne le glas');
        $book1->setAuthor('Ernest Hemingway');
        $manager->persist($book1);
        $this->addReference(self::BOOK1, $book1);

        $book2 = new Book();
        $book2->setName('De sang froid');
        $book2->setAuthor('Truman Capote');
        $manager->persist($book2);
        $this->addReference(self::BOOK2, $book2);

        $book3 = new Book();
        $book3->setName('Zazie dans le métro');
        $book3->setAuthor('Raymond Queneau');
        $manager->persist($book3);
        $this->addReference(self::BOOK3, $book3);

        $book4 = new Book();
        $book4->setName('La jument verte');
        $book4->setAuthor('Marcel Aymé');
        $manager->persist($book4);
        $this->addReference(self::BOOK4, $book4);

        $book5 = new Book();
        $book5->setName('Les frères Karamazov');
        $book5->setAuthor('Fiodo Dostoïevski');
        $manager->persist($book5);
        $this->addReference(self::BOOK5, $book5);

        $book6 = new Book();
        $book6->setName('Le Deuxième Sexe');
        $book6->setAuthor('Simone de Beauvoir');
        $manager->persist($book6);
        $this->addReference(self::BOOK6, $book6);

        $book7 = new Book();
        $book7->setName('Sido');
        $book7->setAuthor('Colette');
        $manager->persist($book7);
        $this->addReference(self::BOOK7, $book7);

        $book8 = new Book();
        $book8->setName('Les mémoires d\'Hadrien');
        $book8->setAuthor('Marguerite Yourcenar');
        $manager->persist($book8);
        $this->addReference(self::BOOK8, $book8);

        $book9 = new Book();
        $book9->setName('Les misérables');
        $book9->setAuthor('Victor Hugo');
        $manager->persist($book9);
        $this->addReference(self::BOOK9, $book9);

        $book10 = new Book();
        $book10->setName('L\'amant');
        $book10->setAuthor('Marguerite Duras');
        $manager->persist($book10);
        $this->addReference(self::BOOK10, $book10);

        $book11 = new Book();
        $book11->setName('Stupeur et Tremblements');
        $book11->setAuthor('Amélie Nothomb');
        $manager->persist($book11);
        $this->addReference(self::BOOK11, $book11);

        $book12 = new Book();
        $book12->setName('Leurs enfants après eux');
        $book12->setAuthor('Nicolas Mathieu');
        $manager->persist($book12);
        $this->addReference(self::BOOK12, $book12);

        $manager->flush();
    }
}
