<?php

namespace App\Tests\Unit\DTO;

use App\DTO\Book\BookDto;
use App\Entity\BookEntity;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class BookDtoTest extends TestCase
{
    #[TestDox("Testando se o handle Entity de DTO")]
    public function testHandle(): void
    {
        $entity = new BookEntity();
        $entity->setTitle('Entidade 1');


        $dto = new BookDto();
        $dto->handleBook($entity);

        $this->assertEquals($entity->getTitle(), $dto->title);
    }
}
