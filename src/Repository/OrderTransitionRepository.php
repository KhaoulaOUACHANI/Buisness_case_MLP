<?php

namespace App\Repository;

use App\Entity\OrderTransition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderTransition>
 *
 * @method OrderTransition|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderTransition|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderTransition[]    findAll()
 * @method OrderTransition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderTransitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderTransition::class);
    }

//    /**
//     * @return OrderTransition[] Returns an array of OrderTransition objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrderTransition
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
