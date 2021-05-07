<?php

namespace App\Repository;

use App\Entity\QuantiteVendu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QuantiteVendu|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuantiteVendu|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuantiteVendu[]    findAll()
 * @method QuantiteVendu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuantiteVenduRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QuantiteVendu::class);
    }



    //  /**
    //   * @return QuantiteVendu[] Returns an array of Entana objects
    //  */
    // public function findTotal($value)
    // {
    //     return $this->createQueryBuilder('q')
    //     ->select('SUM(q.QuantiteVendu)')
    //         ->andWhere('q.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('q.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    public function findDateVendu(/*$value*/)/*: ?int*/
    {
        return $this->createQueryBuilder('q')
            ->select('SUBSTRING(q.Date, 1,10) as Date, COUNT(q) as count')
            ->groupBy('q.Date')
            ->getQuery()
            ->getResult()
        ;
    }

}
