<?php

namespace App\Entity;

use App\Repository\EnginesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EnginesRepository::class)
 */
class Engines
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
     * @ORM\Column(type="integer")
     */
    private $displacement;

    /**
     * @ORM\Column(type="integer")
     */
    private $power;

    /**
     * @ORM\ManyToOne(targetEntity=EngineTypes::class, inversedBy="type")
     */
    private $engineTypes;

    /**
     * @ORM\OneToMany(targetEntity=Cars::class, mappedBy="engines")
     */
    private $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

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

    public function getDisplacement(): ?int
    {
        return $this->displacement;
    }

    public function setDisplacement(int $displacement): self
    {
        $this->displacement = $displacement;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getEngineTypes(): ?EngineTypes
    {
        return $this->engineTypes;
    }

    public function setEngineTypes(?EngineTypes $engineTypes): self
    {
        $this->engineTypes = $engineTypes;

        return $this;
    }

    /**
     * @return Collection|Cars[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Cars $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
            $car->setEngines($this);
        }

        return $this;
    }

    public function removeCar(Cars $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getEngines() === $this) {
                $car->setEngines(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
