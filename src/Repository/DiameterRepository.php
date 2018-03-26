<?php

namespace App\Repository;

use App\Entity\Diameter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Diameter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Diameter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Diameter[]    findAll()
 * @method Diameter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiameterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Diameter::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('d')
            ->where('d.something = :value')->setParameter('value', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
