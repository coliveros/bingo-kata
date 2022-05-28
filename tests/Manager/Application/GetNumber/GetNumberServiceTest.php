<?php

namespace Example\Tests\Manager\Application\GetNumber;

use Example\Manager\Application\GetNumber\GetNumberRequest;
use Example\Manager\Application\GetNumber\GetNumberService;
use Example\Manager\Infrastructure\InmemoryNumbersRepository;
use PHPUnit\Framework\TestCase;

class GetNumberServiceTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_call_number_then_this_number_in_valid_range(): void
    {
        $service = new GetNumberService(new InmemoryNumbersRepository());
        $number = $service->handle(new GetNumberRequest());

        $valid = $number >= 1 || $number <= 75;
        $this->assertTrue($valid);
    }

    /**
     * @test
     */
    public function it_should_is_present_all_number_when_call_75_times(): void
    {
        $service = new GetNumberService(new InmemoryNumbersRepository());
        $request  = new GetNumberRequest();

        $numbers=[];
        for ($i = 1; $i <= 75 ; $i++) {
            $numbers[] = $service->handle($request);
        }

        sort($numbers);
        $this->assertSame($this->allNumbers(), $numbers);

    }

    private function allNumbers()
    {
        $all = [];
        for ($i = 1 ; $i <= 75 ; $i++) {
            $all[] = $i;
        }

        return $all;
    }

}
