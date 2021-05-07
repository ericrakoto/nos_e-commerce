<?php

namespace App\Repository;

use App\Entity\Entana;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\QueryExpressionVisitor;
use Doctrine\ORM\Query\QueryException;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\QuantiteVendu;


/**
 * @method Entana|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entana|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entana[]    findAll()
 * @method Entana[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntanaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Entana::class);
    }

    /**
      * @return Entana[] Returns an array of Entana objects
     */
    
    public function findQuantiteByCategoryAll(int $value)/*: ?int*/
    {
        return $this->createQueryBuilder('e')
            ->select('SUM(e.QuantiteVendu)')
             ->where('e.category= ?1')
            ->setParameter(1, $value)
            ->orderBy('e.category', 'ASC')
            ->groupBy('e.category')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findEntanaVendu()/*: ?int*/
    {
        return $this->createQueryBuilder('e')
            ->select('e.titre_produit, e.vidiny, e.QuantiteVendu, e.sary')
             ->where('e.QuantiteVendu > 0')
            ->getQuery()
            ->getResult()
        ;
    }

    
}
