<?php

namespace Example\Tests\Manager\Application\CardGenerator;

use Example\Manager\Application\CardGenerator\CardGeneratorService;
use PHPUnit\Framework\TestCase;

class CardGeneratorServiceTest extends TestCase
{

    /**
     * @test
     */
    public function it_should_generate_a_card_wtih_valid_structure(): void
    {
        $cardGenerator = new CardGeneratorService();
        $card          = $cardGenerator->handle();

        $this->assertCount(5, $card['B']);
        $this->assertCount(5, $card['I']);
        $this->assertCount(4, $card['N']);
        $this->assertCount(5, $card['G']);
        $this->assertCount(5, $card['O']);
    }

    /**
     * @test
     */
    public function it_should_generate_a_card_wtih_values_in_range(): void
    {
        $cardGenerator = new CardGeneratorService();
        $card          = $cardGenerator->handle();

        $this->assertCount(5, $card['B']);

        $this->validByColumn($card['B'], 1, 15);
        $this->validByColumn($card['I'], 16, 30);
        $this->validByColumn($card['N'], 31, 45);
        $this->validByColumn($card['G'], 46, 60);
        $this->validByColumn($card['O'], 61, 75);

    }

    public function generateNumbers($min, $max): array
    {
        $numbers = [];
        for ($i = $min; $i <= $max; $i++) {
            $numbers[] = $i;
        }
        return $numbers;
    }

    private function validByColumn(array $column, int $min, int $max): void
    {
        foreach ($column as $number) {
            $this->assertContains($number, $this->generateNumbers($min, $max));
        }
    }
}
