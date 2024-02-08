<?php

namespace App\Repository;

use App\Entity\DDD;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DDD>
 *
 * @method DDD|null find($id, $lockMode = null, $lockVersion = null)
 * @method DDD|null findOneBy(array $criteria, array $orderBy = null)
 * @method DDD[]    findAll()
 * @method DDD[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DDDRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DDD::class);
    }

//    /**
//     * @return DDD[] Returns an array of DDD objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DDD
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
