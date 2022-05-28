<?php

namespace Example\Manager\Domain;

abstract class Column
{
    protected $min;
    protected $max;

    abstract public function columns(): int;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function generateNumbers(): array
    {
        $numbers   = [];
        $allowList = [];

        for ($i = $this->min; $i <= $this->max; $i++) {
            $allowList[] = $i;
        }

        $i = 1;
        while($i <= $this->columns()) {
            $randomKey = random_int(0, count($allowList) - 1);
            $numbers[] = $allowList[$randomKey];
            unset($allowList[$randomKey]);
            sort($allowList);
            $i++;
        }


        return $numbers;
    }
}
