<?php

namespace App\Tests\Unit\Services;

use App\DTO\Book\BookDto;
use App\DTO\Book\FilterDto;
use App\Services\BooksService;
use Doctrine\Common\Collections\ArrayCollection;
use Override;
use PHPUnit\Framework\Attributes\TestDox;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BooksServiceTest extends KernelTestCase
{
    private BooksService $booksService;

    #[Override]
    public function setUp(): void
    {
        self::bootKernel();

        $container = self::getContainer();
        $this->booksService = $container->get(BooksService::class);
    }

    #[TestDox('Testando o retorno do método getOne')]
    public function testGetOne(): void
    {
        $dto = $this->booksService->getOne(1);

        $this->assertEquals('Livro TI 1', $dto->title);
    }

    #[TestDox('Testando o método de listagem com filtros, usando filtro por nome')]
    public function testListWithFilter(): void
    {
        $filter = new FilterDto();
        $filter->search = 'Livro TI 1';

        $qb = $this->booksService->listWithFilter($filter);

        $this->assertEquals(1, count($qb->getQuery()->getResult()));
    }

    #[TestDox('Testando o método de listagem com filtros, usando filtro por nome e retorno deve ser vazio')]
    public function testListWithFilterWithoutReturn(): void
    {
        $filter = new FilterDto();
        $filter->search = 'Teste 123';

        $qb = $this->booksService->listWithFilter($filter);

        $this->assertEquals(0, count($qb->getQuery()->getResult()));
    }

    #[TestDox('Testando método de criação')]
    public function testCreate(): void
    {
        $dto = new BookDto();
        $dto->title = 'Livro 2';
        $dto->published_year = 2026;
        $dto->publisher = 'Editora X';
        $dto->price = 100.00;
        $dto->edition = 1;
        $dto->authors = new ArrayCollection();
        $dto->subjects = new ArrayCollection();

        $newDto = $this->booksService->create($dto);

        $this->assertEquals($dto->title, $newDto->title);
    }

    #[TestDox('Testando método de atualização')]
    public function testUpdate(): void
    {
        $dto = new BookDto();
        $dto->title = 'Novo nome';
        $dto->published_year = 2026;
        $dto->publisher = 'Editora X';
        $dto->price = 100.00;
        $dto->edition = 1;
        $dto->authors = new ArrayCollection();
        $dto->subjects = new ArrayCollection();
        $dto->id = 1;

        $this->booksService->update($dto);

        $editDto = $this->booksService->getOne(1);

        $this->assertEquals($dto->title, $editDto->title);
    }

    #[TestDox('Testando método de exclusão')]
    public function testDelete(): void
    {
        $this->booksService->delete(1);

        $this->expectException(NotFoundHttpException::class);

        $this->booksService->getOne(1);
    }
}
