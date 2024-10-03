<?php

namespace App\Repository;

use App\Entity\Poi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Poi>
 */
class PoiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Poi::class);
    }

    /**
     * @return Poi[] Returns an array of Poi objects
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

    public function getPunktWithinRadius($lat, $lon, $radius)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.lat between :lat1 and :lat2')
            ->andWhere('p.lon between :lon1 and :lon2')
            ->setParameter('lat1', $lat - $radius)
            ->setParameter('lat2', $lat + $radius)
            ->setParameter('lon1', $lon - $radius)
            ->setParameter('lon2', $lon + $radius)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    //    /**
    //     * @return Poi[] Returns an array of Poi objects
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

    //    public function findOneBySomeField($value): ?Poi
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
