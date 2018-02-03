<?php

namespace App\Repository;

use App\Entity\Forum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ForumRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Forum::class);
    }

    /**
     * @return array
     */
    public function findAllWithoutParent(int $cat)
    {
        $qb = $this->createQueryBuilder('f');

        $qb->select('f')
            ->where('f.category = '.$cat)
            ->andWhere('f.parent=0')
            ->orderBy('f.position', 'ASC');

        return $qb->getQuery()->getArrayResult();
    }

    public function findByParent(int $parent)
    {
        $qb = $this->createQueryBuilder('f')
            ->andWhere('f.parent = :parent')
            ->setParameter('parent', $parent);

        $query = $qb->getQuery();

        try {
            return $query->getResult(Query::HYDRATE_ARRAY);
        } catch (NoResultException $e) {
            return false;
        }
    }
}
