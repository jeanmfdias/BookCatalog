<?php

namespace App\Services;

use App\DTO\Subject\FilterDto;
use App\Repository\SubjectEntityRepository;
use Doctrine\ORM\QueryBuilder;

class SubjectsService
{

    public function __construct(private SubjectEntityRepository $subjectRepository)
    {

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

}
