<?php

namespace App\DTO\Author;

use App\Entity\AuthorEntity;

class AuthorDto
{
    public ?int $id = null;

    public ?string $name = null;

    public function handleAuthor(AuthorEntity $author): static
    {
        $this->id = $author->getId();
        $this->name = $author->getName();

        return $this;
    }
}
