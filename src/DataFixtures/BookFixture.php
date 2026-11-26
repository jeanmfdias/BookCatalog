<?php

namespace App\DataFixtures;

use App\Entity\BookEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class BookFixture extends Fixture
{
    public function __construct(
        #[Autowire('%app_env%')] private readonly string $appEnv
    ) {
        //
    }
    public function load(ObjectManager $manager): void
    {
        if ($this->appEnv == 'test') {
            $book = new BookEntity();
            $book->setTitle("Livro TI 1");
            $book->setPublished_year(1993);
            $book->setPublisher('Editora de TI');
            $book->setEdition(1);
            $book->setPrice(99.99);
            $manager->persist($book);
        } else {
            for ($i = 0; $i < 1000; $i++) {
                $book = new BookEntity();
                $book->setTitle("Livro TI " . $i + 1);
                $book->setPublished_year(1993);
                $book->setPublisher('Editora de TI');
                $book->setEdition(1);
                $book->setPrice((float) (rand(1, 100) . '.' . rand(0, 99)));
                $manager->persist($book);
            }
        }

        $manager->flush();
    }
}
