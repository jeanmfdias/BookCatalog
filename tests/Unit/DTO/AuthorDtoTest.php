<?php

namespace App\Tests\Unit\DTO;

use App\DTO\Author\AuthorDto;
use App\Entity\AuthorEntity;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class AuthorDtoTest extends TestCase
{
    #[TestDox("Testando se o handle Entity de DTO")]
    public function testHandle(): void
    {
        $entity = new AuthorEntity();
        $entity->setName('Entidade 1');


        $dto = new AuthorDto();
        $dto->handleAuthor($entity);

        $this->assertEquals($entity->getName(), $dto->name);
    }
}
