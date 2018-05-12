<?php

namespace App\Repository;

use App\Entity\EnderecoEletronico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EnderecoEletronico|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnderecoEletronico|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnderecoEletronico[]    findAll()
 * @method EnderecoEletronico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnderecoEletronicoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EnderecoEletronico::class);
    }

//    /**
//     * @return EnderecoEletronico[] Returns an array of EnderecoEletronico objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EnderecoEletronico
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
