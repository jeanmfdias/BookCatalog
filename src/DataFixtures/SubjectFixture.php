<?php

namespace App\DataFixtures;

use App\Entity\SubjectEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class SubjectFixture extends Fixture
{
    public function __construct(
        #[Autowire('%app_env%')] private readonly string $appEnv
    ) {
        //
    }

    public function load(ObjectManager $manager): void
    {
        if ($this->appEnv == 'test') {
            $subject = new SubjectEntity();
            $subject->setDescription('Assunto 1');
            $manager->persist($subject);
        } else {
            for ($i = 0; $i < 1000; $i++) {
                $subject = new SubjectEntity();
                $subject->setDescription('Assunto '. $i + 1);
                $manager->persist($subject);
            }
        }

        $manager->flush();
    }
}
