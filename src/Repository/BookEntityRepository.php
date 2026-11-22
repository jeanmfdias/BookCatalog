<?php

namespace App\Repository;

use App\Entity\BookEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BookEntity>
 */
class BookEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookEntity::class);
    }

    public function add(BookEntity $book, bool $flush = false): void
    {
        $this->getEntityManager()->persist($book);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function update(): void
    {
        $this->getEntityManager()->flush();
    }

    public function remove(BookEntity $book, bool $flush = false): void
    {
        $this->getEntityManager()->remove($book);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function selectAll(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('b')
            ->orderBy('b.title', 'asc');

        return $qb;
    }
}
