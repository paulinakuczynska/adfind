<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mapformat
 *
 * @ORM\Table(name="MapFormat", indexes={@ORM\Index(name="file_id", columns={"file_id"}), @ORM\Index(name="format_id", columns={"format_id"})})
 * @ORM\Entity
 */
class Mapformat
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
     * @var \File
     * @ORM\ManyToOne(targetEntity="App\Entity\File", inversedBy="mapformat")
     */
    private $file;

    /**
     * @var \Format
     * @ORM\ManyToOne(targetEntity="App\Entity\Format", inversedBy="mapformat")
     */
    private $format;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function getFormat(): ?Format
    {
        return $this->format;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setFormat(?Format $format): self
    {
        $this->format = $format;

        return $this;
    }

}
