<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Category
 *
 * @ORM\Table(name="Category")
 * @UniqueEntity("name")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var Category[]
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var Collection|Category[]
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="parent")
     */
    private $children;

    /**
     * @var Collection|File[]
     * @ORM\OneToMany(targetEntity="App\Entity\File", mappedBy="category", orphanRemoval=true, fetch="EXTRA_LAZY")
     */
    private $files;

    public function __construct()
    {
        $this->files = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return Collection|self[]
     */

    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @return Collection|File[]
     */

    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setParent($parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    public function addFile(File $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setCategory($this);
        }

        return $this;
    }

    public function removeFile(File $file): self
    {
        if ($this->files->contains($file)) {
            $this->files->removeElement($file);
            if ($file->getCategory() === $this) {
                $file->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

}
