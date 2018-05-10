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

    public function getUsedDecorationItemsInYear($year)
    {
        return $this->createQueryBuilder('decoration_item')
            ->leftJoin('decoration_item.balloon', 'balloon')
            ->leftJoin('decoration_item.decoration', 'decoration')
            ->leftJoin('decoration.celebration', 'celebration')
            ->where('decoration_item.isActive = :active',
                    'decoration.isActive = :active',
                    'celebration.isActive = :active',
                    'YEAR(celebration.date) = :year')
            ->setParameters([
                'active' => true,
                'year' => $year,
            ])
            ->select('balloon.isActive',
                    'balloon.name',
                    'SUM(decoration_item.quantity) AS quantity',
                    'decoration_item.price')
            ->groupBy('balloon.isActive', 'balloon.name', 'decoration_item.price')
            ->orderBy('balloon.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
