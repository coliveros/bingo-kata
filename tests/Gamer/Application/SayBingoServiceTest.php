<?php

namespace Example\Tests\Gamer\Application;

use Example\Gamer\Application\SayBingo\SayBingoService;
use Example\Manager\Domain\Card;
use Example\Manager\Domain\GamerIsNotCompleteException;
use Example\Manager\Domain\NumbersRepository;
use Example\Manager\Infrastructure\InmemoryNumbersRepository;
use PHPUnit\Framework\TestCase;

class SayBingoServiceTest extends TestCase
{

    /**
     * @test
     */
    public function it_should_lose_when_your_card_is_incomplete(): void
    {
        $card = new Card();
        $card->card();
        $card->mark(1);
        $card->mark(66);

        $this->expectException(GamerIsNotCompleteException::class);
        $sayBingo = new SayBingoService(new InmemoryNumbersRepository());
        $result   = $sayBingo->check($card);
    }

    /**
     * @test
     */
    public function it_should_win_when_your_card_is_complete(): void
    {
        $card = new Card();
        $card->card();

        foreach ($this->numbersWinners() as $winnerNumber) {
            $card->mark($winnerNumber);
        }

        $repository = $this->createMock(NumbersRepository::class);
        $repository->method('numberInUse')->willReturn($this->numbersInUse());


        $sayBingo = new SayBingoService($repository);

        $result   = $sayBingo->check($card);
        $this->assertTrue($result);
    }

    private function numbersInUse()
    {
        return [
            1, 2, 5, 6, 8,
            17, 18, 20, 22, 23, 35, 29, 30,
            31, 33, 35, 37, 38, 44, 45,
            47, 49, 50, 55, 56, 57, 48,
            66, 67, 68, 69, 70, 71
        ];
    }

    private function numbersWinners(): array
    {
        return [
            1, 2, 5, 6, 8,
            17, 18, 20, 22, 23,
            31, 33, 35, 37,
            47, 49, 50, 55, 56,
            66, 67, 68, 69, 70
        ];
    }
}
