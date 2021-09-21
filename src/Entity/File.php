<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="File",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="name_hash", columns={"name_hash"})},
 *     indexes={@ORM\Index(name="category_id", columns={"category_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 */
class File
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
     * @ORM\Column(name="name_hash", type="string", length=32, nullable=false, options={"fixed"=true})
     */
    private $nameHash;

    /**
     * @var string|null
     * @ORM\Column(name="name_add", type="string", length=255, nullable=true)
     */
    private $nameAdd;

    /**
     * @var string
     * @ORM\Column(name="name_view", type="string", length=255, nullable=false)
     */
    private $nameView;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="files")
     */
    private $category;

    /**
     * @var Collection|Tag[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="files")
     * @ORM\JoinTable(
     *     name="MapTag",
     *     joinColumns={@ORM\JoinColumn(name="file_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id", nullable=false)})
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameHash(): ?string
    {
        return $this->nameHash;
    }

    public function getNameAdd(): ?string
    {
        return $this->nameAdd;
    }

    public function getNameView(): ?string
    {
        return $this->nameView;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @return Collection|Tag[]
     */

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function setNameHash(string $nameHash): self
    {
        $this->nameHash = $nameHash;

        return $this;
    }

    public function setNameAdd(string $nameAdd): self
    {
        $this->nameAdd = $nameAdd;

        return $this;
    }

    public function setNameView(?string $nameView): self
    {
        $this->nameView = $nameView;

        return $this;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

}
