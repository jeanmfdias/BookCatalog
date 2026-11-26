<?php

namespace App\Tests\Unit\Entities;

use App\DTO\Book\BookDto;
use App\Entity\BookEntity;
use App\Exceptions\Book\BookHandleException;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class BookEntityTest extends TestCase
{
    #[TestDox('Teste do método handle DTO para Entity')]
    public function testHandleDto(): void
    {
        $dto = new BookDto();
        $dto->title = "Título DTO";
        $dto->publisher = "Editora";
        $dto->published_year = '2000';
        $dto->edition = 1;
        $dto->price = 123.45;
        $dto->isbn = '12345';
        $entity = new BookEntity();

        $entity->handleDto($dto);

        $this->assertEquals($dto->title, $entity->getTitle());
    }

    #[TestDox('Teste do método handle DTO para Entity, validando erro na execução')]
    public function testHandleDtoWithError(): void
    {
        $dto = new BookDto();
        $entity = new BookEntity();

        $this->expectException(BookHandleException::class);

        $entity->handleDto($dto);
    }
}
