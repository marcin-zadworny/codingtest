<?php

namespace App\Machine\Validator;

use App\Machine\CigarettePurchaseTransaction;

class InsufficientAmountValidator
{
    /**
     * @throws InsufficientAmountException
     */
    public function validate(int $itemQuantity, float $paidAmount): void
    {
        $total = $itemQuantity * CigarettePurchaseTransaction::ITEM_PRICE;

        if ($total > $paidAmount) {
            throw new InsufficientAmountException(InsufficientAmountConstraint::MESSAGE);
        }
    }
}
