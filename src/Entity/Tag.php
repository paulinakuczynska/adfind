<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Tag
 *
 * @ORM\Table(name="Tag")
 * @UniqueEntity("name")
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
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
     * @ORM\Column(name="name", type="string", length=30, nullable=false, unique=true)
     * @Assert\NotBlank(message = "This value cannot be blank.")
     * @Assert\Regex(
     *     pattern="/[^\w ]/",
     *     match = false,
     *     message = "The name cannot contain special characters except for the low dash.")
     * @Assert\Length(
     *     min = 1,
     *     max = 30,
     *     maxMessage = "The name cannot contain more than 30 characters.")
     */
    private $name;

    /**
     * @var Collection|File[]
     * @ORM\ManyToMany(targetEntity="App\Entity\File", mappedBy="tags", fetch="EXTRA_LAZY")
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

    public function addFile(File $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->addTag($this);
        }

        return $this;
    }

    public function removeFile(File $file): self
    {
        if ($this->files->contains($file)) {
            $this->files->removeElement($file);
            $file->removeTag($this);
        }

        return $this;
    }

}
