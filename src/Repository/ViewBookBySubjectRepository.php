<?php

namespace App\Repository;

use App\Entity\ViewBookBySubject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ViewBookBySubject>
 */
class ViewBookBySubjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ViewBookBySubject::class);
    }
}
