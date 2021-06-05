<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarsRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Cars
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Marks::class, inversedBy="cars")
     */
    private $marks;

    /**
     * @ORM\ManyToOne(targetEntity=Engines::class, inversedBy="cars")
     */
    private $engines;

    /**
     * @ORM\ManyToOne(targetEntity=CarBodys::class, inversedBy="cars")
     */
    private $carBodys;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        //$this->name = $this->marks. " " .$this->engines. " " .$this->carBodys;
        $this->createdAt = new \DateTime();
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMarks(): ?Marks
    {
        return $this->marks;
    }

    public function setMarks(?Marks $marks): self
    {
        $this->marks = $marks;

        return $this;
    }

    public function getEngines(): ?Engines
    {
        return $this->engines;
    }

    public function setEngines(?Engines $engines): self
    {
        $this->engines = $engines;

        return $this;
    }

    public function getCarBodys(): ?CarBodys
    {
        return $this->carBodys;
    }

    public function setCarBodys(?CarBodys $carBodys): self
    {
        $this->carBodys = $carBodys;

        return $this;
    }
}
