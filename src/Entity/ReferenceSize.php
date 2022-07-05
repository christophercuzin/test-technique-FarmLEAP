<?php

namespace App\Entity;

use App\Repository\ReferenceSizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReferenceSizeRepository::class)]
class ReferenceSize
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $referenceSize;

    #[ORM\OneToMany(mappedBy: 'referenceSize', targetEntity: Size::class)]
    private $sizes;

    public function __construct()
    {
        $this->sizes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferenceSize(): ?int
    {
        return $this->referenceSize;
    }

    public function setReferenceSize(int $referenceSize): self
    {
        $this->referenceSize = $referenceSize;

        return $this;
    }

    /**
     * @return Collection<int, Size>
     */
    public function getSizes(): Collection
    {
        return $this->sizes;
    }

    public function addSize(Size $size): self
    {
        if (!$this->sizes->contains($size)) {
            $this->sizes[] = $size;
            $size->setReferenceSize($this);
        }

        return $this;
    }

    public function removeSize(Size $size): self
    {
        if ($this->sizes->removeElement($size)) {
            // set the owning side to null (unless already changed)
            if ($size->getReferenceSize() === $this) {
                $size->setReferenceSize(null);
            }
        }

        return $this;
    }

    public function getSum(): int|float
    { 
        $allSizes = [];  
        foreach ($this->sizes as $size) {
            
            $allSizes[] = $size->getSize();
        }
        return (array_sum($allSizes)/100);
    }

    public function getAvg(): int|float
    {
        $allSizes = [];  
        foreach ($this->sizes as $size) {
            
            $allSizes[] = $size->getSize();
        }
        return (array_sum($allSizes)/count($allSizes)/100);
    }

    public function getSmallest(): int|float
    {
        $allSizes = [];  
        foreach ($this->sizes as $size) {
            
            $allSizes[] = $size->getSize();
        }
        $allSizes[] = sort( $allSizes);
        return ($allSizes[0]/100);
    }

    public function getGreatest(): int|float
    {
        $allSizes = [];  
        foreach ($this->sizes as $size) {
            
            $allSizes[] = $size->getSize();
        }
        $allSizes[] = rsort( $allSizes);
        return ($allSizes[0]/100);
    }
}
