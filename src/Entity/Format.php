<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Format
 *
 * @ORM\Table(name="Format")
 * @ORM\Entity
 */
class Format
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
     * @var \Mapformat
     * @ORM\OneToMany(targetEntity="App\Entity\Mapformat", mappedBy="format", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    private $mapformats;

    public function __construct()
    {
        $this->mapformats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getMapFormats(): Collection
    {
        return $this->mapformats;
    }

    public function getFiles()
    {
        return array_map(
            function ($mapformat) {
                return $mapformat->getFiles();
            },
            $this->mapformats->toArray()
        );
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function removeMapformat(Mapformat $mapformat)
    {
        if ($this->mapformats->contains($mapformat)) {
            $this->mapformats->removeElement($mapformat);
            $mapformat->setFormat(null);
        }

        return $this;
    }


}
