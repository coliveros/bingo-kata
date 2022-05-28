<?php

namespace Example\Manager\Application\CardGenerator;

use Example\Manager\Domain\Card;

class CardGeneratorService
{
    public function handle(): array
    {
        $card = new Card();
        return $card->card();
    }
}
