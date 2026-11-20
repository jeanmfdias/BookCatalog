<?php

namespace App\Repository;

use App\Entity\SubjectEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SubjectEntity>
 */
class SubjectEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubjectEntity::class);
    }

    public function add(SubjectEntity $subject, bool $flush = false): void
    {
        $this->getEntityManager()->persist($subject);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SubjectEntity $subject, bool $flush = false): void
    {
        $this->getEntityManager()->remove($subject);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function selectAll(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('s')
            ->orderBy('s.description', 'asc');

        return $qb;
    }

//    /**
//     * @return SubjectEntity[] Returns an array of SubjectEntity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SubjectEntity
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
