<?php

namespace Example\Manager\Domain;

class Card
{
    private $numbersMarks = [];

    public function card()
    {
        return [
            'B' => (new ColumnNormal(1, 15))->generateNumbers(),
            'I' => (new ColumnNormal(16, 30))->generateNumbers(),
            'N' => (new ColumnWithSpace(31, 45))->generateNumbers(),
            'G' => (new ColumnNormal(46, 60))->generateNumbers(),
            'O' => (new ColumnNormal(61, 75))->generateNumbers()
        ];
    }

    public function mark($number)
    {
        $this->numbersMarks[] = $number;
    }

    public function numerbersMarks(): array
    {
        return $this->numbersMarks;
    }
}
