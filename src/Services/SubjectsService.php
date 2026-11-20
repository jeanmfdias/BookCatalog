<?php

namespace App\Services;

use App\DTO\Subject\FilterDto;
use App\DTO\Subject\SubjectDto;
use App\Entity\SubjectEntity;
use App\Repository\SubjectEntityRepository;
use Doctrine\ORM\QueryBuilder;

class SubjectsService
{

    public function __construct(private SubjectEntityRepository $subjectRepository)
    {

    }

    public function getOne(int $id): SubjectDto
    {
        $subject = $this->subjectRepository->find($id);

        $subjectDto = new SubjectDto();
        $subjectDto->handleSubject($subject);

        return $subjectDto;
    }

    public function listWithFilter(FilterDto $filter): QueryBuilder
    {
        $qb = $this->subjectRepository->selectAll();

        if ($filter->search) {
            if ((int) $filter->search == $filter->search) {
                $qb->orWhere('s.id = :id')
                    ->setParameter('id', (int) $filter->search);
            }

            $qb->orWhere('LOWER(s.description) LIKE :description')
                ->setParameter('description', '%' . mb_strtolower(trim($filter->search)) . '%');
        }

        return $qb;
    }

    public function create(SubjectDto $subjectDto): SubjectEntity
    {
        $subject = new SubjectEntity();
        $subject->handleDto($subjectDto);

        $this->subjectRepository->add($subject, true);

        return $subject;
    }
}
