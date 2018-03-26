<?php

namespace App\Repository;

use App\Entity\LocationType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LocationType|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocationType|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocationType[]    findAll()
 * @method LocationType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LocationType::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('l')
            ->where('l.something = :value')->setParameter('value', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
