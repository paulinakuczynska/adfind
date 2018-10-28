<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="Tag", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"name"})})
 * @ORM\Entity
 */
class Tag
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
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @var \File
     * @ManyToMany(targetEntity="App\Entity\File", mappedBy="tags", fetch="EXTRA_LAZY")
     */
    private $files;

    public function __construct()
    {
        $this->files = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function addFile(File $file)
    {
        if ($this->files->contains($file)) {
            return;
        }
        $this->files->add($file);
        $file->addTag($this);
    }

    public function removeFile(File $file)
    {
        if (!$this->files->contains($file)) {
            return;
        }
        $this->files->removeElement($file);
        $file->removeTag($this);
    }

}
