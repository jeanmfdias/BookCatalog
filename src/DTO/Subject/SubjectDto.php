<?php

namespace App\DTO\Subject;

use App\Entity\SubjectEntity;
use App\Exceptions\Subject\SubjectHandleException;
use Exception;

class SubjectDto
{
    public ?int $id = null;

    public ?string $description = null;

    public function handleSubject(SubjectEntity $subject): static
    {
        try {
            $this->id = $subject->getId();
            $this->description = $subject->getDescription();
        } catch (Exception $e) {
            throw new SubjectHandleException('Erro ao atribuir Entidade ao DTO.');
        }

        return $this;
    }
}
