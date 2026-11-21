<?php

namespace App\DataFixtures;

use App\Entity\SubjectEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $subject = new SubjectEntity();
        $subject->setDescription('Assunto 1');
        $manager->persist($subject);

        $manager->flush();
    }
}
