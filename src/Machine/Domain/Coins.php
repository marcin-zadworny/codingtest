<?php

namespace App\Machine\Domain;

class Coins
{
    public const PENNY1 = 0.01;
    public const PENNY2 = 0.02;

    private float $denomination;
    private int $count;

    public function __construct(float $denomination, int $count = 0)
    {
        $this->denomination = $denomination;
        $this->count = $count;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getDenomination(): float
    {
        return $this->denomination;
    }

    public function calculate(float $amount): self
    {
        if ($amount <= 0) {
            return $this;
        }

        $this->count = floor($amount / $this->denomination);

        return $this;
    }
}
