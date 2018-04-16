<?php

namespace App\Repository;

use App\Entity\DecorationItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DecorationItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method DecorationItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method DecorationItem[]    findAll()
 * @method DecorationItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DecorationItemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DecorationItem::class);
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
