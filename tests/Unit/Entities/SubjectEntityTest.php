<?php

namespace App\Tests\Unit\Entities;

use App\DTO\Book\BookDto;
use App\DTO\Subject\SubjectDto;
use App\Entity\BookEntity;
use App\Entity\SubjectEntity;
use App\Exceptions\Book\BookHandleException;
use App\Exceptions\Subject\SubjectHandleException;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class SubjectEntityTest extends TestCase
{
    #[TestDox('Teste do método handle DTO para Entity')]
    public function testHandleDto(): void
    {
        $dto = new SubjectDto();
        $dto->description = "Assunto DTO";
        $entity = new SubjectEntity();

        $entity->handleDto($dto);

        $this->assertEquals($dto->description, $entity->getDescription());
    }

    #[TestDox('Teste do método handle DTO para Entity, validando erro na execução')]
    public function testHandleDtoWithError(): void
    {
        $dto = new SubjectDto();
        $entity = new SubjectEntity();

        $this->expectException(SubjectHandleException::class);

        $entity->handleDto($dto);
    }
}
