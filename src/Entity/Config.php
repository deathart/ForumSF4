<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config.
 *
 * @ORM\Table(name="config")
 * @ORM\Entity(repositoryClass="App\Repository\ConfigRepository")
 */
class Config
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=250, nullable=false)
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", nullable=false)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=250, nullable=false, options={"default"="simple"})
     */
    private $type = 'simple';

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }
}
