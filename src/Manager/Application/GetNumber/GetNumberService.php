<?php

namespace Example\Manager\Application\GetNumber;

use Example\Manager\Domain\NumbersRepository;

class GetNumberService
{
    private NumbersRepository $repository;

    public function __construct(NumbersRepository $repository)
    {

        $this->repository = $repository;
    }
    public function handle(GetNumberRequest $request): int
    {
        return $this->repository->number();
    }
}
