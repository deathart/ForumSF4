<?php

namespace App\Repository;

use App\Entity\Config;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ConfigRepository.
 */
class ConfigRepository extends ServiceEntityRepository
{
    /**
     * ConfigRepository constructor.
     *
     * @param \Symfony\Bridge\Doctrine\RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Config::class);
    }

    /**
     * @param string $name
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findDataByKey(string $name)
    {
        $qb = $this->createQueryBuilder('c')
            ->andWhere('c.name = :name')
            ->setParameter('name', $name);

        $query = $qb->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $e) {
            return false;
        }
    }
}
