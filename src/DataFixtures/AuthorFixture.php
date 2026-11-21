<?php

namespace App\DataFixtures;

use App\Entity\AuthorEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $author = new AuthorEntity();
        $author->setName("Autor Teste 1");
        $manager->persist($author);

        $manager->flush();
    }
}
