<?php

namespace App\Entity;

use App\Repository\ViewBookBySubjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ViewBookBySubjectRepository::class)]
class ViewBookBySubject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $subject_name = null;

    #[ORM\Column]
    private ?int $total_books = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubjectName(): ?string
    {
        return $this->subject_name;
    }

    public function setSubjectName(string $subject_name): static
    {
        $this->subject_name = $subject_name;

        return $this;
    }

    public function getTotalBooks(): ?int
    {
        return $this->total_books;
    }

    public function setTotalBooks(int $total_books): static
    {
        $this->total_books = $total_books;

        return $this;
    }
}
