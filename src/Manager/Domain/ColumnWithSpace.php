<?php

namespace Example\Manager\Domain;

class ColumnWithSpace extends Column
{

    public function columns(): int
    {
        return 4;
    }
}
