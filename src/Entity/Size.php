<?php

namespace App\Entity;

use App\Repository\SizeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SizeRepository::class)]
class Size
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $size;

    #[ORM\ManyToOne(targetEntity: ReferenceSize::class, inversedBy: 'sizes')]
    private $referenceSize;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getReferenceSize(): ?ReferenceSize
    {
        return $this->referenceSize;
    }

    public function setReferenceSize(?ReferenceSize $referenceSize): self
    {
        $this->referenceSize = $referenceSize;

        return $this;
    }
}
