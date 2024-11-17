<?php

namespace App\Repository;

use App\Entity\DateDeNaissance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DateDeNaissance>
 *
 * @method DateDeNaissance|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateDeNaissance|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateDeNaissance[]    findAll()
 * @method DateDeNaissance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateDeNaissanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateDeNaissance::class);
    }

    public function save(DateDeNaissance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DateDeNaissance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DateDeNaissance[] Returns an array of DateDeNaissance objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DateDeNaissance
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
