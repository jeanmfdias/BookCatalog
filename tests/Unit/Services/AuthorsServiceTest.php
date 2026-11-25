<?php

namespace App\Tests\Unit\Services;

use App\DTO\Author\AuthorDto;
use App\DTO\Author\FilterDto;
use App\Services\AuthorsService;
use Override;
use PHPUnit\Framework\Attributes\TestDox;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthorsServiceTest extends KernelTestCase
{
    private AuthorsService $authorsService;

    #[Override]
    public function setUp(): void
    {
        self::bootKernel();

        $container = self::getContainer();
        $this->authorsService = $container->get(AuthorsService::class);
    }

    #[TestDox('Testando o retorno do método getOne')]
    public function testGetOne(): void
    {
        $dto = $this->authorsService->getOne(1);

        $this->assertEquals('Autor Teste 1', $dto->name);
    }

    #[TestDox('Testando o método de listagem com filtros, usando filtro por nome')]
    public function testListWithFilter(): void
    {
        $filter = new FilterDto();
        $filter->search = 'Teste 1';

        $qb = $this->authorsService->listWithFilter($filter);

        $this->assertEquals(1, count($qb->getQuery()->getResult()));
    }

    #[TestDox('Testando o método de listagem com filtros, usando filtro por nome e retorno deve ser vazio')]
    public function testListWithFilterWithoutReturn(): void
    {
        $filter = new FilterDto();
        $filter->search = 'Teste 123';

        $qb = $this->authorsService->listWithFilter($filter);

        $this->assertEquals(0, count($qb->getQuery()->getResult()));
    }

    #[TestDox('Testando método de criação')]
    public function testCreate(): void
    {
        $dto = new AuthorDto();
        $dto->name = 'Autor 2';

        $newDto = $this->authorsService->create($dto);

        $this->assertEquals($dto->name, $newDto->name);
    }

    #[TestDox('Testando método de atualização')]
    public function testUpdate(): void
    {
        $dto = new AuthorDto();
        $dto->name = 'Novo nome';
        $dto->id = 1;

        $this->authorsService->update($dto);

        $editDto = $this->authorsService->getOne(1);

        $this->assertEquals($dto->name, $editDto->name);
    }

    #[TestDox('Testando método de exclusão')]
    public function testDelete(): void
    {
        $this->authorsService->delete(1);

        $this->expectException(NotFoundHttpException::class);

        $this->authorsService->getOne(1);
    }
}
