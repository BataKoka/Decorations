<?php

namespace App\Repository;

use App\Entity\ColorType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ColorType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ColorType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ColorType[]    findAll()
 * @method ColorType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColorTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ColorType::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.something = :value')->setParameter('value', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
