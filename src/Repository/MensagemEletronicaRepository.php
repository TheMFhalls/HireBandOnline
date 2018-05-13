<?php

namespace App\Repository;

use App\Entity\MensagemEletronica;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MensagemEletronica|null find($id, $lockMode = null, $lockVersion = null)
 * @method MensagemEletronica|null findOneBy(array $criteria, array $orderBy = null)
 * @method MensagemEletronica[]    findAll()
 * @method MensagemEletronica[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MensagemEletronicaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MensagemEletronica::class);
    }

//    /**
//     * @return MensagemEletronica[] Returns an array of MensagemEletronica objects
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
    public function findOneBySomeField($value): ?MensagemEletronica
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
