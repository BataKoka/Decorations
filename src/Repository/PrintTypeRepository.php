<?php

namespace App\Repository;

use App\Entity\PrintType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrintType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrintType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrintType[]    findAll()
 * @method PrintType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrintTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrintType::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findAllActive()
    {
        return $this->createQueryBuilder('print_type')
            ->andWhere('print_type.isActive = :value')->setParameter('value', true)
            ->orderBy('print_type.name', 'ASC');
    }
}
