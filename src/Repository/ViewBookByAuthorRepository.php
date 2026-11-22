<?php

namespace App\Repository;

use App\Entity\ViewBookByAuthor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ViewBookByAuthor>
 */
class ViewBookByAuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ViewBookByAuthor::class);
    }
}
