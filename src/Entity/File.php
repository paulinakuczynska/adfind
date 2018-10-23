<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
/**
 * File
 *
 * @ORM\Table(name="File", indexes={@ORM\Index(name="subcategory_id", columns={"subcategory_id"})})
 * @ORM\Entity
 */
class File
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name_add", type="string", length=255, nullable=false)
     */
    private $nameAdd;

    /**
     * @var string|null
     * @ORM\Column(name="name_view", type="string", length=255, nullable=true)
     */
    private $nameView;

    /**
     * @var string
     * @ORM\Column(name="name_hash", type="string", length=255, nullable=false)
     */
    private $nameHash;

    /**
     * @var \Subcategory
     * @ORM\ManyToOne(targetEntity="App\Entity\Subcategory", inversedBy="files")
     */
    private $subcategory;

    /**
     * @var \Maptag
     * @ORM\OneToMany(targetEntity="App\Entity\Maptag", mappedBy="file", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    private $maptags;

    /**
     * @var \Mapformat
     * @ORM\OneToMany(targetEntity="App\Entity\Mapformat", mappedBy="file", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    private $mapformats;

    public function __constructTag()
    {
        $this->maptags = new ArrayCollection();
    }

    public function __constructFormat()
    {
        $this->mapformats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameAdd(): ?string
    {
        return $this->nameAdd;
    }

    public function getNameView(): ?string
    {
        return $this->nameView;
    }

    public function getNameHash(): ?string
    {
        return $this->nameHash;
    }

    public function getSubcategory(): ?Subcategory
    {
        return $this->subcategory;
    }

    public function getMaptags(): Collection
    {
        return $this->maptags;
    }

    public function getMapformats(): Collection
    {
        return $this->mapformats;
    }

    public function getTags()
    {
        return array_map(
            function ($maptag) {
                return $maptag->getTags();
            },
            $this->maptags->toArray()
        );
    }

    public function getFormats()
    {
        return array_map(
            function ($mapformat) {
                return $mapformat->getFormats();
            },
            $this->mapformats->toArray()
        );
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

    public function setNameHash(string $nameHash): self
    {
        $this->nameHash = $nameHash;

        return $this;
    }

    public function setSubcategory(?Subcategory $subcategory): self
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    public function addMaptag(Maptag $maptag)
    {
        if (!$this->maptags->contains($maptag)) {
            $this->maptags->add($maptag);
            $maptag->setTag($this);
        }

        return $this;
    }

    public function addMapformat(Mapformat $mapformat)
    {
        if (!$this->mapformats->contains($mapformat)) {
            $this->mapformats->add($mapformat);
            $mapformat->setFormat($this);
        }

        return $this;
    }

    public function removeMaptag(Maptag $maptag)
    {
        if ($this->maptags->contains($maptag)) {
            $this->maptags->removeElement($maptag);
            $maptag->setTag(null);
        }

        return $this;
    }

    public function removeMapformat(Mapformat $mapformat)
    {
        if ($this->mapformats->contains($mapformat)) {
            $this->mapformats->removeElement($mapformat);
            $mapformat->setFormat(null);
        }

        return $this;
    }

}
