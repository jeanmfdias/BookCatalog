<?php

namespace App\Services;

use App\DTO\Author\FilterDto;
use App\DTO\Author\AuthorDto;
use App\Entity\AuthorEntity;
use App\Repository\AuthorEntityRepository;
use Doctrine\ORM\QueryBuilder;

class AuthorsService
{

    public function __construct(private AuthorEntityRepository $authorRepository)
    {

    }

    public function getOne(int $id): AuthorDto
    {
        $author = $this->authorRepository->find($id);

        $authorDto = new AuthorDto();
        $authorDto->handleAuthor($author);

        return $authorDto;
    }

    public function listWithFilter(FilterDto $filter): QueryBuilder
    {
        $qb = $this->authorRepository->selectAll();

        if ($filter->search) {
            if ((int) $filter->search == $filter->search) {
                $qb->orWhere('a.id = :id')
                    ->setParameter('id', (int) $filter->search);
            }

            $qb->orWhere('LOWER(a.name) LIKE :name')
                ->setParameter('name', '%' . mb_strtolower(trim($filter->search)) . '%');
        }

        return $qb;
    }

    public function create(AuthorDto $authorDto): AuthorDto
    {
        $author = new AuthorEntity();
        $author->handleDto($authorDto);

        $this->authorRepository->add($author, true);

        return (new AuthorDto)->handleAuthor($author);
    }

    public function update(AuthorDto $authorDto): AuthorDto
    {
        $author = $this->authorRepository->find($authorDto->id);

        $author->setName($authorDto->name);

        $this->authorRepository->update();

        return (new AuthorDto)->handleAuthor($author);
    }

    public function delete(int $id): bool
    {
        $author = $this->authorRepository->find($id);

        $this->authorRepository->remove($author, true);

        return true;
    }
}
