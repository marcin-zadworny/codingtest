<?php

namespace App\Machine;

/**
 * Interface PurchasableItemInterface
 * @package App\Machine
 */
interface PurchaseTransactionInterface
{
    public function getItemQuantity(): int;
    public function getPaidAmount(): float;
    public function getItemPrice(): float;
}
