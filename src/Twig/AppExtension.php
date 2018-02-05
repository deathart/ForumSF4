<?php

namespace App\Twig;

use App\Entity\Config;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class AppExtension.
 */
class AppExtension extends AbstractExtension
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    /**
     * AppExtension constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('config', [$this, 'configFilter']),
        ];
    }

    /**
     * @param string $key
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function configFilter(string $key)
    {
        $configVal = $this->em->getRepository(Config::class)->findDataByKey($key);

        if ($configVal) {
            return $configVal->getValue();
        }

        return false;
    }
}
