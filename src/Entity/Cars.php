<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=BlogPosts::class, mappedBy="cars")
     */
    private $post;

    public function __construct()
    {
        $this->post = new ArrayCollection();
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

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|BlogPosts[]
     */
    public function getPost(): Collection
    {
        return $this->post;
    }

    public function addPost(BlogPosts $post): self
    {
        if (!$this->post->contains($post)) {
            $this->post[] = $post;
            $post->setCars($this);
        }

        return $this;
    }

    public function removePost(BlogPosts $post): self
    {
        if ($this->post->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getCars() === $this) {
                $post->setCars(null);
            }
        }

        return $this;
    }
}
