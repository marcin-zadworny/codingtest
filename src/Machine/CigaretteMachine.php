<?php

namespace App\Machine;

use App\Machine\UseCase\CalculateChange;

/**
 * Class CigaretteMachine
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
    private CalculateChange $calculateChange;

    public function __construct()
    {
        $this->calculateChange = new CalculateChange();
    }

    public function execute(PurchaseTransactionInterface $purchaseTransaction): PurchasedItemInterface
    {
        $totalAmount = $this->calculateTotalAmount($purchaseTransaction);
        $change = $this->calculateChange->calculate($purchaseTransaction->getPaidAmount(), $totalAmount);

        return new CigarettePurchasedItem($purchaseTransaction->getItemQuantity(), $totalAmount, $change);
    }

    private function calculateTotalAmount(PurchaseTransactionInterface $purchaseTransaction): float
    {
        return $purchaseTransaction->getItemQuantity() * $purchaseTransaction->getItemPrice();
    }
}
