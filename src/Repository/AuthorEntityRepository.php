<?php

namespace App\Repository;

use App\Entity\AuthorEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AuthorEntity>
 */
class AuthorEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuthorEntity::class);
    }

    public function add(AuthorEntity $author, bool $flush = false): void
    {
        $this->getEntityManager()->persist($author);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function update(): void
    {
        $this->getEntityManager()->flush();
    }

    public function remove(AuthorEntity $author, bool $flush = false): void
    {
        $this->getEntityManager()->remove($author);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function selectAll(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.name', 'asc');

        return $qb;
    }
}
