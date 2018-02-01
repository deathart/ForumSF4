<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="desc", type="text", nullable=false)
     */
    private $desc;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=250, nullable=false, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="integer", nullable=false, options={"default":"0" })
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="parent", type="integer", nullable=false, options={"default":"0" })
     */
    private $parent;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->forum = new ArrayCollection();
    }

    /**
     * Get forums.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getForum(): Collection
    {
        return $this->forum;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->desc;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function getParent(): int
    {
        return $this->parent;
    }
}
