<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }


    /**
     * @return int|mixed|string
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function nombreArticles():Integer
    {
        $qb = $this->createQueryBuilder('a');

        $qb->select('COUNT(a.id) AS nombre')
            ->where('a.status= true');
        return $qb->getQuery()->getSingleScalarResult();
    }


    /**
     * @param int|null $limit
     * @param int|null $currentPage
     * @return array
     */
    public function articlesPerPageNoFilter(int $limit=null,int $currentPage=null):array
    {
        $qb = $this->createQueryBuilder('a')
            ->setFirstResult($currentPage)
            ->setMaxResults($limit)
            //->orderBy('a.createdAt', 'DESC')
        ;
        return $qb->getQuery()->getResult();
    }


    /**
     * @param int $limit
     * @param int $currentPage
     * @return array|null
     */
    public function articlesPerPage(int $limit=null,int $currentPage=null):array
    {
        $qb = $this->createQueryBuilder('a')
            ->setFirstResult($currentPage)
            ->setMaxResults($limit)
            /**************************************************/
            //                  First method                  /
            /************************************************/

            ->where('a.image not like :image')
            ->andwhere('a.createdAt BETWEEN :dateDebut AND :dateFin')
            ->andWhere('a.status not like :disabled')
            ->setParameter('dateDebut', '2020-01-01')
            ->setParameter('dateFin', '2020-12-31')
            ->setParameter('image', '11.jpg')
            ->setParameter('disabled', 0)
            ->orderBy('a.createdAt', 'DESC')

            /**************************************************/
            //          second method   Range of dates        /
            /************************************************/
//            ->where("a.createdAt >= :dateDebut")
//            ->andWhere("a.createdAt <= :dateFin")
//            ->setParameter('dateDebut', '2020-01-01')
//            ->setParameter('dateFin', '2020-12-31')

        ;
        //dump(count($qb->getQuery()->getResult()));
        //dump(($qb->getQuery()->getResult()));die;
        return $qb->getQuery()->getResult();
    }


//SELECT * FROM article ORDER BY created_at DESC LIMIT 1, 10;



    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
