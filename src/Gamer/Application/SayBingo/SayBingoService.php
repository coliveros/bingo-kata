<?php

namespace Example\Gamer\Application\SayBingo;

use Example\Manager\Domain\Card;
use Example\Manager\Domain\GamerIsNotCompleteException;
use Example\Manager\Domain\NumbersRepository;


class SayBingoService
{
    private $repository;

    public function __construct(NumbersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function check(Card $card): bool
    {
        $numbersInUse = $this->repository->numberInUse();

        if (count($card->numerbersMarks()) !== 24) {
            throw new GamerIsNotCompleteException();
        }

        $checker = 0;
        foreach ($card->numerbersMarks() as $numberInCard) {
            if (in_array($numberInCard, $numbersInUse, true)) {
                $checker++;
            }
        }

        if ($checker !== 24) {
            throw new \Exception('Gamer is mark number not called');
        }

        return true;
    }
}
