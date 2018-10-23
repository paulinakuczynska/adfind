<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Maptag
 *
 * @ORM\Table(name="MapTag", indexes={@ORM\Index(name="file_id", columns={"file_id"}), @ORM\Index(name="tag_id", columns={"tag_id"})})
 * @ORM\Entity
 */
class Maptag
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
     * @ORM\ManyToOne(targetEntity="App\Entity\File", inversedBy="maptag")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", nullable=FALSE)
     */
    private $file;

    /**
     * @var \Tag
     * @ORM\ManyToOne(targetEntity="App\Entity\Tag", inversedBy="maptag")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id", nullable=FALSE)
     */
    private $tag;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function getTag(): ?Tag
    {
        return $this->tag;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setTag(?Tag $tag): self
    {
        $this->tag = $tag;

        return $this;
    }


}
