<?php

namespace App\Repository;

use App\Entity\StatusCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatusCommande>
 *
 * @method StatusCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusCommande[]    findAll()
 * @method StatusCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusCommande::class);
    }

//    /**
//     * @return StatusCommande[] Returns an array of StatusCommande objects
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

//    public function findOneBySomeField($value): ?StatusCommande
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
