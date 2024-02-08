<?php

namespace App\Repository;

use App\Entity\AA;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AA>
 *
 * @method AA|null find($id, $lockMode = null, $lockVersion = null)
 * @method AA|null findOneBy(array $criteria, array $orderBy = null)
 * @method AA[]    findAll()
 * @method AA[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AARepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AA::class);
    }

//    /**
//     * @return AA[] Returns an array of AA objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AA
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
