<?php

namespace App\Machine\Domain;

class Change
{
    private Coins $penny2;
    private Coins $penny1;

    public function __construct(Coins $penny2, Coins $penny1)
    {
        $this->penny2 = $penny2;
        $this->penny1 = $penny1;
    }

    public function getPenny2(): Coins
    {
        return $this->penny2;
    }

    public function getPenny1(): Coins
    {
        return $this->penny1;
    }

    public function toNative(): array
    {
        return [
            [
                $this->penny2->getDenomination(),
                $this->penny2->getCount()
            ],
            [
                $this->penny1->getDenomination(),
                $this->penny1->getCount()
            ],
        ];
    }
}