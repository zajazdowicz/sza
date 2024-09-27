<?php

namespace App\Repository;

use App\Entity\POI;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<POI>
 */
class POIRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, POI::class);
    }

         /**
        * @return POI[] Returns an array of POI objects
        */
       public function findWizytyokwa(array $ids): array
       {
           return $this->createQueryBuilder('p')
               ->andWhere('p.id_openstreetmap in (:val)')
               ->setParameter('val', $ids)
               ->orderBy('p.id', 'ASC')
               ->getQuery()
               ->getResult()
           ;
       }
    //    /**
    //     * @return POI[] Returns an array of POI objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?POI
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
