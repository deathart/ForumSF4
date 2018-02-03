<?php

namespace App\Repository;

use App\Entity\Forum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ForumRepository.
 */
class ForumRepository extends ServiceEntityRepository
{
    /**
     * ForumRepository constructor.
     *
     * @param \Symfony\Bridge\Doctrine\RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Forum::class);
    }

    /**
     * @param int $cat
     *
     * @return array
     */
    public function findAllWithoutParent(int $cat): array
    {
        $qb = $this->createQueryBuilder('f')
            ->select('f')
            ->where('f.category = :category')
            ->andWhere('f.parent=0')
            ->orderBy('f.position', 'ASC')
            ->setParameter('category', $cat);

        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @param int $parent
     *
     * @return array
     */
    public function findWithParent(int $parent): array
    {
        $qb = $this->createQueryBuilder('f')
            ->andWhere('f.parent = :parent')
            ->setParameter('parent', $parent);

        return $qb->getQuery()->getArrayResult();
    }
}
