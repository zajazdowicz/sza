<?php

namespace App\Repository;

use App\Entity\Ingredients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ingredients>
 */
class IngredientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingredients::class);
    }

           /**
        * @return Ingredients[] Returns an array of Ingredients objects
        */
       public function findtIngredientsByNames(array $value): array
       {
           return $this->createQueryBuilder('i')
               ->andWhere('i.name in (:val)')
               ->setParameter('val', $value)
               ->setMaxResults(10)
               ->getQuery()
               ->getResult()
           ;
       }
       public function save(Ingredients $ingredients, bool $flush = false): void
    {
        $this->_em->persist($ingredients);

        if ($flush) {
            $this->_em->flush();
        }
    }

    //    /**
    //     * @return Ingredients[] Returns an array of Ingredients objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Ingredients
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
