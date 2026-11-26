<?php

namespace App\DTO\Book;

use App\Entity\AuthorEntity;
use App\Entity\BookEntity;
use App\Exceptions\Book\BookHandleException;
use Doctrine\Common\Collections\Collection;
use Exception;

class BookDto
{
    public ?int $id = null;

    public ?string $title = null;

    public ?string $publisher = null;

    public ?string $published_year = null;

    public ?int $edition = null;

    public ?float $price = null;

    public ?string $isbn = null;

    public ?Collection $authors = null;

    public ?Collection $subjects = null;

    public function handleBook(BookEntity $book): static
    {
        try {
            $this->id = $book->getId();
            $this->title = $book->getTitle();
            $this->publisher = $book->getPublisher();
            $this->published_year = $book->getPublished_year();
            $this->edition = $book->getEdition();
            $this->price = $book->getPrice();
            $this->isbn = $book->getIsbn();
            $this->authors = $book->getAuthors();
            $this->subjects = $book->getSubjects();
        } catch (Exception $e) {
            throw new BookHandleException('Erro ao atribuir a Entidade no DTO.', $e->getCode());
        }

        return $this;
    }
}
