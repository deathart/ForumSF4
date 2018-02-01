<?php

namespace App\Repository;

use App\Entity\Forum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
}
