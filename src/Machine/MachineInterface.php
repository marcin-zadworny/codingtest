<?php

namespace App\Machine;

/**
 * Interface CigaretteMachine
 * @package App\Machine
 */
interface MachineInterface
{
    public function execute(PurchaseTransactionInterface $purchaseTransaction): PurchasedItemInterface;
}
