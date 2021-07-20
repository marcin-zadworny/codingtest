<?php

namespace App\Machine;

use App\Machine\Domain\Change;

class CigarettePurchasedItem implements PurchasedItemInterface
{
    private int $itemQuantity;
    private float $totalAmount;
    private Change $change;

    public function __construct(int $itemQuantity, float $totalAmount, Change $change)
    {
        $this->itemQuantity = $itemQuantity;
        $this->totalAmount = $totalAmount;
        $this->change = $change;
    }

    public function getItemQuantity(): int
    {
        return $this->itemQuantity;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function getChange(): Change
    {
        return $this->change;
    }
}
