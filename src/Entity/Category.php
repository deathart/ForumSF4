<?php

namespace App\Entity;

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
     * @return mixed
     */
    public function getId () {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId ($id): void {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName (): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName (string $name): void {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDesc (): string {
        return $this->desc;
    }

    /**
     * @param string $desc
     */
    public function setDesc (string $desc): void {
        $this->desc = $desc;
    }

    /**
     * @return string
     */
    public function getSlug (): string {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug (string $slug): void {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getPosition (): string {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition (string $position): void {
        $this->position = $position;
    }

}
