<?php

namespace Machine;

use App\Machine\Domain\Change;
use App\Machine\UseCase\CalculateChange;
use PHPUnit\Framework\TestCase;

class CalculateChangeTest extends TestCase
{
    /**
     * @test
     */
    public function calculate_change_if_there_is_none(): void
    {
        //given
        $calculateChange = new CalculateChange();

        //when
        $change = $calculateChange->calculate(4.55, 4.99);

        //then
        $this->seePennies2($change, 0);
        $this->seePennies1($change, 0);
    }

    /**
     * @test
     */
    public function calculate_change_only_with_pennies1(): void
    {
        //given
        $calculateChange = new CalculateChange();

        //when
        $change = $calculateChange->calculate(5, 4.99);

        //then
        $this->assertEquals(1, $change->getPenny1()->getCount());
    }

    /**
     * @test
     */
    public function calculate_change_only_with_pennies2(): void
    {
        //given
        $calculateChange = new CalculateChange();

        //when
        $change = $calculateChange->calculate(5, 4.98);

        //then
        $this->assertEquals(1, $change->getPenny2()->getCount());
    }

    /**
     * @test
     */
    public function calculate_change_with_both_coins(): void
    {
        //given
        $calculateChange = new CalculateChange();

        //when
        $change = $calculateChange->calculate(5, 4.95);

        //then
        $this->assertEquals(1, $change->getPenny1()->getCount());
        $this->assertEquals(2, $change->getPenny2()->getCount());
    }

    private function seePennies2(Change $change, int $expectedCount)
    {
        $this->assertEquals($expectedCount, $change->getPenny2()->getCount());
    }

    private function seePennies1(Change $change, int $expectedCount)
    {
        $this->assertEquals($expectedCount, $change->getPenny1()->getCount());
    }
}