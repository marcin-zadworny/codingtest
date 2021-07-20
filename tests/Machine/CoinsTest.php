<?php

namespace Machine;

use App\Machine\Domain\Coins;
use PHPUnit\Framework\TestCase;

class CoinsTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideAmountForCalculationsPenny2Count
     */
    public function calculate_2_penny_count(float $amount, int $expectedCoinCount): void
    {
        $coin = new Coins(Coins::PENNY2);
        $coin->calculate($amount);

        $this->assertEquals($expectedCoinCount, $coin->getCount());
    }

    /**
     * @test
     * @dataProvider provideAmountForCalculationsPenny1Count
     */
    public function calculate_1_penny_count(float $amount, int $expectedCoinCount): void
    {
        $coin = new Coins(Coins::PENNY1);
        $coin->calculate($amount);

        $this->assertEquals($expectedCoinCount, $coin->getCount());
    }

    /**
     * @return float[][]
     */
    public function provideAmountForCalculationsPenny2Count(): array
    {
        return [
            [-0.05, 0],
            [0, 0],
            [0.05, 2],
            [1, 50],
        ];
    }

    /**
     * @return float[][]
     */
    public function provideAmountForCalculationsPenny1Count(): array
    {
        return [
            [-0.05, 0],
            [0, 0],
            [0.05, 5],
            [1, 100],
        ];
    }
}
