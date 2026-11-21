<?php

namespace App\DTO\Book;

use App\Entity\AuthorEntity;
use App\Entity\BookEntity;
use Doctrine\Common\Collections\Collection;

class BookDto
{
    public ?int $id = null;

    public ?string $title = null;

    public ?string $publisher = null;

    public ?string $published_year = null;

    public ?int $edition = null;

    public ?Collection $authors = null;

    public ?Collection $subjects = null;

    public function handleBook(BookEntity $book): static
    {
        $this->id = $book->getId();
        $this->title = $book->getTitle();
        $this->publisher = $book->getPublisher();
        $this->published_year = $book->getPublished_year();
        $this->edition = $book->getEdition();
        $this->authors = $book->getAuthors();
        $this->subjects = $book->getSubjects();

        return $this;
    }
}
