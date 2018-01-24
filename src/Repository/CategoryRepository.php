<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends ServiceEntityRepository
{
    /**
     * CategoryRepository constructor.
     *
     * @param \Symfony\Bridge\Doctrine\RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return array
     */
    public function findAllWithoutParent(): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.parent = 0')
            ->orderBy('c.postition', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param int $parent
     *
     * @return bool|mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByParent(int $parent)
    {
        $qb = $this->createQueryBuilder('c')
            ->andWhere('c.parent = :parent')
            ->setParameter('parent', $parent);

        $query = $qb->getQuery();

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (NoResultException $e) {
            return false;
        }
    }
}
