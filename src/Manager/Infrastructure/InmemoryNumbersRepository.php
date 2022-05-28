<?php

namespace Example\Manager\Infrastructure;

use Example\Manager\Domain\NumbersRepository;
use Exception;

class InmemoryNumbersRepository implements NumbersRepository
{
    private $numbers = [];
    private $numbersInUse = [];

    public function __construct()
    {
        $this->generateNumbers();
        $this->cleanNumbersInUse();
    }

    public function number(): int
    {
        $newNumber = random_int(1, 75);
        if (count($this->numbersInUse) === 75) {
            throw new Exception('Already call all numbers');
        }
        if (in_array($newNumber, $this->numbersInUse, true)) {
            return $this->number();
        }
        $this->numbersInUse[] = $newNumber;
        return $newNumber;
    }

    private function generateNumbers(): void
    {
        for ($i = 1 ; $i <= 75 ; $i++) {
            $this->numbers[] = $i;
        }
    }

    private function cleanNumbersInUse()
    {
        $this->numbersInUse = [];
    }

    public function numberInUse(): array
    {
        return $this->numbersInUse;
    }
}
