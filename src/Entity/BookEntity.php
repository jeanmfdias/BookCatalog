<?php

namespace App\Entity;

use App\Repository\BookEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookEntityRepository::class)]
#[ORM\Table(name: 'books')]
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

    #[ORM\ManyToMany(targetEntity: AuthorEntity::class, inversedBy: 'books')]
    #[ORM\JoinTable(name: 'book_author')]
    #[ORM\JoinColumn(name: 'book_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'author_id', referencedColumnName: 'id')]
    private Collection $authors;

    #[ORM\ManyToMany(targetEntity: SubjectEntity::class, inversedBy: 'subjects')]
    #[ORm\JoinTable(name: 'book_subject')]
    #[ORM\JoinColumn(name: 'book_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'subject_id', referencedColumnName: 'id')]
    private Collection $subjects;

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

    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(AuthorEntity $author): static
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
        }

        return $this;
    }

    public function removeAuthor(AuthorEntity $author): static
    {
        $this->authors->removeElement($author);

        return $this;
    }

    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(SubjectEntity $subject): static
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects->add($subject);
        }

        return $this;
    }

    public function removeSubject(SubjectEntity $subject): static
    {
        $this->subjects->removeElement($subject);

        return $this;
    }
}
