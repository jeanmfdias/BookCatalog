<?php

namespace App\Entity;

use App\DTO\Author\AuthorDto;
use App\Repository\AuthorEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorEntityRepository::class)]
#[ORM\Table(name: 'authors')]
class AuthorEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: BookEntity::class, mappedBy: 'authors')]
    private Collection $books;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    public function handleDto(AuthorDto $authorDto): static
    {
        $this->setName($authorDto->name);
        return $this;
    }
}
