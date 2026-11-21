<?php

namespace App\DTO\Author;

use App\Entity\AuthorEntity;
use App\Exceptions\Author\AuthorHandleException;
use Exception;

class AuthorDto
{
    public ?int $id = null;

    public ?string $name = null;

    /**
     * @throws AuthorHandleException
     */
    public function handleAuthor(AuthorEntity $author): static
    {
        try {
            $this->id = $author->getId();
            $this->name = $author->getName();
        } catch (Exception $e) {
            throw new AuthorHandleException("Erro ao atribuir Entidade ao DTO", $e->getCode());
        }

        return $this;
    }
}
