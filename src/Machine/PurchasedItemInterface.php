<?php

namespace App\Machine;

use App\Machine\Domain\Change;

/**
 * Interface PurchasedItemInterface
 * @package App\Machine
 */
interface PurchasedItemInterface
{
    public function getItemQuantity(): int;
    public function getTotalAmount(): float;
    public function getChange(): Change;
}
