<?php

namespace Example\Manager\Domain;

class ColumnNormal extends Column
{
    public function columns(): int
    {
        return 5;
    }
}
