<?php

namespace App\Repository;

use App\Entity\Size;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Size>
 *
 * @method Size|null find($id, $lockMode = null, $lockVersion = null)
 * @method Size|null findOneBy(array $criteria, array $orderBy = null)
 * @method Size[]    findAll()
 * @method Size[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Size::class);
    }

    public function add(Size $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Size $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findSum(): array
    {
        $connexion = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT r.id, (SUM(size)/100) as sum FROM  size s 
        INNER JOIN reference_size r
        on r.id = s.reference_size_id
        GROUP BY r.id
        ';

        $statement = $connexion->prepare($sql);
        $result = $statement->executeQuery();

        return $result->fetchAllAssociative();
    }

    public function findAvg(): array
    {
        $connexion = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT r.id, (AVG(size)/100) as avg FROM  size s 
        INNER JOIN reference_size r
        on r.id = s.reference_size_id
        GROUP BY r.id
        ';

        $statement = $connexion->prepare($sql);
        $result = $statement->executeQuery();

        return $result->fetchAllAssociative();
    }

//    /**
//     * @return Size[] Returns an array of Size objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Size
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
