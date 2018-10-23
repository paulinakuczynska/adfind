<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="Tag")
 * @ORM\Entity
 */
class Tag
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \Maptag
     * @ORM\OneToMany(targetEntity="App\Entity\Maptag", mappedBy="tag", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    private $maptags;

    public function __construct()
    {
        $this->maptags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getMapTags(): Collection
    {
        return $this->maptags;
    }

    public function getFiles()
    {
        return array_map(
            function ($maptag) {
                return $maptag->getFiles();
            },
            $this->maptags->toArray()
        );
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function removeMaptag(Maptag $maptag)
    {
        if ($this->maptags->contains($maptag)) {
            $this->maptags->removeElement($maptag);
            $maptag->setTag(null);
        }

        return $this;
    }

}
