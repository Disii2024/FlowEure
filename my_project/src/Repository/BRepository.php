<?php

namespace App\Repository;

use App\Entity\B;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<B>
 *
 * @method B|null find($id, $lockMode = null, $lockVersion = null)
 * @method B|null findOneBy(array $criteria, array $orderBy = null)
 * @method B[]    findAll()
 * @method B[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, B::class);
    }

//    /**
//     * @return B[] Returns an array of B objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?B
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
