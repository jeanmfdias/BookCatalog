<?php

namespace App\Entity;

use App\Repository\ViewBookAllDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ViewBookAllDetailRepository::class)]
#[ORM\Table(name: 'vw_books_all_details')]
class ViewBookAllDetail
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

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column]
    private ?string $authors = null;

    #[ORM\Column]
    private ?string $subjects = null;

    public function getId(): ?int
    {
        return $this->id;
    }

     public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    public function getEdition(): ?int
    {
        return $this->edition;
    }

    public function getPublished_year(): ?string
    {
        return $this->published_year;
    }

    public function getPrice(): float
    {
        return $this->price ?? 0;
    }

    public function getAuthors(): ?string
    {
        return $this->authors ?? null;
    }

    public function getSubjects(): ?string
    {
        return $this->subjects ?? null;
    }
}
