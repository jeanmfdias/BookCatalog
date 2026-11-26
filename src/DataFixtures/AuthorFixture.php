<?php

namespace App\DataFixtures;

use App\Entity\AuthorEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class AuthorFixture extends Fixture
{
    public function __construct(
        #[Autowire('%app_env%')] private readonly string $appEnv
    ) {
        //
    }
    public function load(ObjectManager $manager): void
    {
        if ($this->appEnv == 'test') {
            $author = new AuthorEntity();
            $author->setName("Autor Teste 1");
            $manager->persist($author);
        } else {
            for ($i = 0; $i < 1000; $i++) {
                $author = new AuthorEntity();
                $author->setName("Autor Teste " . $i + 1);
                $manager->persist($author);
            }
        }

        $manager->flush();
    }
}
