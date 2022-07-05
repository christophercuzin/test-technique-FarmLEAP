<?php

namespace App\Service;

use App\Entity\ReferenceSize;
use App\Entity\Size;
use Doctrine\ORM\EntityManagerInterface;

class SizeUtils
{
    private EntityManagerInterface $entityManager;
    private RetrieveSize $retrieveSize;

    public function __construct(EntityManagerInterface $entityManager,RetrieveSize $retrieveSize)
    {
        $this->entityManager = $entityManager;
        $this->retrieveSize = $retrieveSize;
    }

    public function flushReferenceSize(array $sizeData): ReferenceSize
    {
        $entityManager = $this->entityManager;
        $referenceSize = new ReferenceSize;

        $referenceSize->setReferenceSize($sizeData['reference_size']);
        $entityManager->persist($referenceSize);
        $entityManager->flush();
        
        return $referenceSize;
    }

    public function flushSize(ReferenceSize $referenceSize, array $sizeData): void
    {
        $entityManager = $this->entityManager;
        $sizes = $this->retrieveSize->retrievAllSize($sizeData);
        if(!empty($sizes)) {
            foreach ($sizes as $sizeValue) {
                $size = new Size;
                $size->setSize($sizeValue);
                $size->setReferenceSize($referenceSize);
                $entityManager->persist($size);
            }
        }
        $entityManager->flush();
    }
}