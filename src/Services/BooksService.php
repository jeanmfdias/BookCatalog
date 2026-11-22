<?php

namespace App\Services;

use App\DTO\Book\FilterDto;
use App\DTO\Book\BookDto;
use App\Entity\BookEntity;
use App\Repository\BookEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BooksService
{

    public function __construct(private BookEntityRepository $bookRepository)
    {
        //
    }

    public function getOne(int $id): BookDto
    {
        $book = $this->find($id);

        $bookDto = new BookDto();
        $bookDto->handleBook($book);

        return $bookDto;
    }

    public function listWithFilter(FilterDto $filter): QueryBuilder
    {
        $qb = $this->bookRepository->selectAll();

        if ($filter->search) {
            if ((int) $filter->search == $filter->search) {
                $qb->orWhere('b.id = :id')
                    ->setParameter('id', (int) $filter->search);
            }

            $qb->orWhere('LOWER(b.title) LIKE :title')
                ->setParameter('title', '%' . mb_strtolower(trim($filter->search)) . '%');
        }

        return $qb;
    }

    public function create(BookDto $bookDto): BookDto
    {
        $book = new BookEntity();
        $book->handleDto($bookDto);

        $this->bookRepository->add($book, true);

        $this->postCreateBook($bookDto, $book);

        return (new BookDto)->handleBook($book);
    }

    public function update(BookDto $bookDto): BookDto
    {
        $book = $this->find($bookDto->id);

        $book->handleDto($bookDto);

        $this->bookRepository->update();

        return (new BookDto)->handleBook($book);
    }

    public function delete(int $id): bool
    {
        $book = $this->find($id);

        $this->bookRepository->remove($book, true);

        return true;
    }

    private function find(int $id): BookEntity
    {
        $book = $this->bookRepository->find($id);

        if (!$book) {
            throw new NotFoundHttpException('Livro não encontrado.');
        }

        return $book;
    }

    private function postCreateBook(BookDto $bookDto, BookEntity $book): void
    {
        $book->handleDto($bookDto);

        $this->bookRepository->update();
    }
}
