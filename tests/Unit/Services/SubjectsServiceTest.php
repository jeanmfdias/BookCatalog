<?php

namespace App\Tests\Unit\Services;

use App\DTO\Subject\FilterDto;
use App\DTO\Subject\SubjectDto;
use App\Services\SubjectsService;
use Override;
use PHPUnit\Framework\Attributes\TestDox;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SubjectsServiceTest extends KernelTestCase
{
    private SubjectsService $subjectsService;

    #[Override]
    public function setUp(): void
    {
        self::bootKernel();

        $container = self::getContainer();
        $this->subjectsService = $container->get(SubjectsService::class);
    }

    #[TestDox('Testando o retorno do método getOne')]
    public function testGetOne(): void
    {
        $dto = $this->subjectsService->getOne(1);

        $this->assertEquals('Assunto 1', $dto->description);
    }

    #[TestDox('Testando o método de listagem com filtros, usando filtro por nome')]
    public function testListWithFilter(): void
    {
        $filter = new FilterDto();
        $filter->search = 'Assunto 1';

        $qb = $this->subjectsService->listWithFilter($filter);

        $this->assertEquals(1, count($qb->getQuery()->getResult()));
    }

    #[TestDox('Testando o método de listagem com filtros, usando filtro por nome e retorno deve ser vazio')]
    public function testListWithFilterWithoutReturn(): void
    {
        $filter = new FilterDto();
        $filter->search = 'Teste 123';

        $qb = $this->subjectsService->listWithFilter($filter);

        $this->assertEquals(0, count($qb->getQuery()->getResult()));
    }

    #[TestDox('Testando método de criação')]
    public function testCreate(): void
    {
        $dto = new SubjectDto();
        $dto->description = 'Assunto 2';

        $newDto = $this->subjectsService->create($dto);

        $this->assertEquals($dto->description, $newDto->description);
    }

    #[TestDox('Testando método de atualização')]
    public function testUpdate(): void
    {
        $dto = new SubjectDto();
        $dto->description = 'Novo nome';
        $dto->id = 1;

        $this->subjectsService->update($dto);

        $editDto = $this->subjectsService->getOne(1);

        $this->assertEquals($dto->description, $editDto->description);
    }

    #[TestDox('Testando método de exclusão')]
    public function testDelete(): void
    {
        $this->subjectsService->delete(1);

        $this->expectException(NotFoundHttpException::class);

        $this->subjectsService->getOne(1);
    }
}
