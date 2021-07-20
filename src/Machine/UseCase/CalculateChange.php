<?php

declare(strict_types=1);

namespace App\Machine\UseCase;

use App\Machine\Domain\Change;
use App\Machine\Domain\Coins;

class CalculateChange
{
    public function calculate(float $paidAmount, float $totalAmount): Change
    {
        $restAmount = $this->calculateInitialRestAmount($paidAmount, $totalAmount);
        $penny2 = new Coins(Coins::PENNY2);
        $penny1 = new Coins(Coins::PENNY1);

        if ($restAmount <= 0) {
            return new Change($penny2, $penny1);
        }

        $penny2->calculate($restAmount);

        $restAmount = $this->calculateRestAmountWithoutPennies2($restAmount, $penny2);
        $penny1->calculate($restAmount);

        return new Change($penny2, $penny1);
    }

    private function calculateInitialRestAmount(float $paidAmount, float $totalAmount): float
    {
        return $this->subtractFloatingPointNumbers($paidAmount, $totalAmount);
    }

    private function calculateRestAmountWithoutPennies2(float $restAmount, Coins $penny2): float
    {
        $pennies2Amount = $penny2->getCount()*$penny2->getDenomination();

        return $this->subtractFloatingPointNumbers($restAmount, $pennies2Amount);
    }

    private function subtractFloatingPointNumbers(float $number1, float $number2)
    {
        $number1 = round($number1, 2);
        $number2 = round($number2, 2);

        return round((($number1*100) - ($number2*100))/100, 2);
    }
}
