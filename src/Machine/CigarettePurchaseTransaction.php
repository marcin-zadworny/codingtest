<?php

namespace App\Machine;

use App\Machine\Validator\InsufficientAmountValidator;

class CigarettePurchaseTransaction implements PurchaseTransactionInterface
{
    public const ITEM_PRICE = 4.99;

    private int $itemQuantity;
    private float $paidAmount;

    /**
     * @throws Validator\InsufficientAmountException
     */
    public function __construct(int $itemQuantity, float $paidAmount)
    {
        $validator = new InsufficientAmountValidator();
        $validator->validate($itemQuantity, $paidAmount);

        $this->itemQuantity = $itemQuantity;
        $this->paidAmount = $paidAmount;
    }

    public function getItemQuantity(): int
    {
        return $this->itemQuantity;
    }

    public function getPaidAmount(): float
    {
        return $this->paidAmount;
    }

    public function getItemPrice(): float
    {
        return self::ITEM_PRICE;
    }
}
