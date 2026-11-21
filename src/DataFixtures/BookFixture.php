<?php

namespace App\DataFixtures;

use App\Entity\BookEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $book = new BookEntity();
        $book->setTitle("Livro TI 1");
        $book->setPublished_year(1993);
        $book->setPublisher('Editora de TI');
        $book->setEdition(1);
        $manager->persist($book);

        $manager->flush();
    }
}
