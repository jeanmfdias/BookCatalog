<?php

namespace App\Tests\Unit\Entities;

use App\DTO\Author\AuthorDto;
use App\Entity\AuthorEntity;
use App\Exceptions\Author\AuthorHandleException;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class AuthorEntityTest extends TestCase
{
    #[TestDox('Teste do método handle DTO para Entity')]
    public function testHandleDto(): void
    {
        $dto = new AuthorDto();
        $dto->name = "Autor DTO";
        $entity = new AuthorEntity();

        $entity->handleDto($dto);

        $this->assertEquals($dto->name, $entity->getName());
    }

    #[TestDox('Teste do método handle DTO para Entity, validando erro na execução')]
    public function testHandleDtoWithError(): void
    {
        $dto = new AuthorDto();
        $entity = new AuthorEntity();

        $this->expectException(AuthorHandleException::class);

        $entity->handleDto($dto);
    }
}
