<?php

namespace App\Repository;

use App\Entity\Mensagem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Mensagem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mensagem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mensagem[]    findAll()
 * @method Mensagem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MensagemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mensagem::class);
    }

//    /**
//     * @return Mensagem[] Returns an array of Mensagem objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mensagem
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
