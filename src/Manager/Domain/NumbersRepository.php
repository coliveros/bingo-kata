<?php

namespace Example\Manager\Domain;

interface NumbersRepository
{
    public function number(): int;

    public function numberInUse(): array;
}
