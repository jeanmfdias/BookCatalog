<?php

namespace App\Entity;

use App\Repository\ViewBookByAuthorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true, repositoryClass: ViewBookByAuthorRepository::class)]
#[ORM\Table(name: 'vw_books_by_authors')]
class ViewBookByAuthor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $author_name = null;

    #[ORM\Column]
    private ?int $total_books = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor_name(): ?string
    {
        return $this->author_name;
    }

    public function getTotal_books(): ?int
    {
        return $this->total_books;
    }
}
