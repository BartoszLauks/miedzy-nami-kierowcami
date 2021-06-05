<?php

namespace App\Entity;

use App\Repository\EngineTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EngineTypesRepository::class)
 */
class EngineTypes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Engines::class, mappedBy="engineTypes")
     */
    private $type;

    public function __construct()
    {
        $this->type = new ArrayCollection();
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

    /**
     * @return Collection|Engines[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(Engines $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
            $type->setEngineTypes($this);
        }

        return $this;
    }

    public function removeType(Engines $type): self
    {
        if ($this->type->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getEngineTypes() === $this) {
                $type->setEngineTypes(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
