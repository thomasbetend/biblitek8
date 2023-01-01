<?php

namespace App\Repository;

use App\Entity\IdealBibliotheque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IdealBibliotheque>
 *
 * @method IdealBibliotheque|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdealBibliotheque|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdealBibliotheque[]    findAll()
 * @method IdealBibliotheque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdealBibliothequeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdealBibliotheque::class);
    }

    public function save(IdealBibliotheque $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(IdealBibliotheque $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return IdealBibliotheque[] Returns an array of IdealBibliotheque objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?IdealBibliotheque
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
