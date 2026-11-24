<?php

namespace App\Tests\Unit\DTO;

use App\DTO\Subject\SubjectDto;
use App\Entity\SubjectEntity;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class SubjectDtoTest extends TestCase
{
    #[TestDox("Testando se o handle Entity de DTO")]
    public function testHandle(): void
    {
        $entity = new SubjectEntity();
        $entity->setDescription('Entidade 1');

        $dto = new SubjectDto();
        $dto->handleSubject($entity);

        $this->assertEquals($entity->getDescription(), $dto->description);
    }
}
