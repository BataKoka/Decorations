<?php

namespace App\Repository;

use App\Entity\CelebrationType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CelebrationType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CelebrationType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CelebrationType[]    findAll()
 * @method CelebrationType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CelebrationTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CelebrationType::class);
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

    /*
    public function findAllActive()
    {
        return $this->createQueryBuilder('celebrationType')
            ->where('celebrationType.isActive = :value')->setParameter('value', true)
            ->orderBy('celebrationType.name', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    */
}
