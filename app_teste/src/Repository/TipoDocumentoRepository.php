<?php

namespace App\Repository;

use App\Entity\TipoDocumento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TipoDocumento>
 *
 * @method TipoDocumento|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoDocumento|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoDocumento[]    findAll()
 * @method TipoDocumento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoDocumentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoDocumento::class);
    }

    public function save(TipoDocumento $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TipoDocumento $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TipoDocumento[] Returns an array of TipoDocumento objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

   public function findTipoDocumentoById($idTD): ?TipoDocumento
   {
       return $this->createQueryBuilder('t')
           ->andWhere('t.id = :val')
           ->setParameter('val', $idTD)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }
}
