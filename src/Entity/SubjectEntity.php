<?php

namespace App\Entity;

use App\Repository\SubjectEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectEntityRepository::class)]
#[ORM\Table(name: 'subjects')]
class SubjectEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: BookEntity::class, mappedBy: 'books')]
    private Collection $books;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(BookEntity $book): static
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
        }

        return $this;
    }

    public function removeBook(BookEntity $book): static
    {
        $this->books->removeElement($book);

        return $this;
    }
}
