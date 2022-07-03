<?php

 namespace App\Service;

 class RetrieveSize
 {
    private array $retrieveSize;

    public function retrievAllSize($sizeData): array
    {
        $numberOfField = $sizeData['number_of_field'];
        for ($i=0; $i < $numberOfField; $i++) { 
            $this->retrieveSize[] = $sizeData['new_field' . $i];
        }
        return $this->retrieveSize;
    }

 }