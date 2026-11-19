<?php

namespace App\Entity;

use App\Repository\BookEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookEntityRepository::class)]
class BookEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $title = null;

    #[ORM\Column(length: 40)]
    private ?string $publisher = null;

    #[ORM\Column]
    private ?int $edition = null;

    #[ORM\Column(length: 4)]
    private ?string $published_year = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    public function setPublisher(string $publisher): static
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getEdition(): ?int
    {
        return $this->edition;
    }

    public function setEdition(int $edition): static
    {
        $this->edition = $edition;

        return $this;
    }

    public function getPublishedYear(): ?string
    {
        return $this->published_year;
    }

    public function setPublishedYear(string $published_year): static
    {
        $this->published_year = $published_year;

        return $this;
    }
}
