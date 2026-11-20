<?php

namespace App\DTO\Subject;

use App\Entity\SubjectEntity;

class SubjectDto
{
    public ?int $id = null;

    public ?string $description = null;

    public function handleSubject(SubjectEntity $subject): static
    {
        $this->id = $subject->getId();
        $this->description = $subject->getDescription();

        return $this;
    }
}
