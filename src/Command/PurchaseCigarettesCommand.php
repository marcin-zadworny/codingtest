<?php

namespace App\Command;

use App\Machine\CigaretteMachine;
use App\Machine\PurchasedItemInterface;
use App\Machine\CigarettePurchaseTransaction;
use App\Machine\Validator\InsufficientAmountException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CigaretteMachine
 * @package App\Command
 */
class PurchaseCigarettesCommand extends Command
{
    private const PURCHASE_MSG = 'You bought <info>%d</info> packs of cigarettes for <info>%01.2f</info>, each for <info>%01.2f</info>.';
    private const CHANGE_MSG = 'Your change is:';

    protected function configure(): void
    {
        $this->addArgument('packs', InputArgument::REQUIRED, "How many packs do you want to buy?");
        $this->addArgument('amount', InputArgument::REQUIRED, "The amount in euro.");
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $itemCount = (int) $input->getArgument('packs');
        $amount = (float) str_replace(',', '.', $input->getArgument('amount'));

        try {
            $cigaretteMachine = new CigaretteMachine();
            $purchase = $cigaretteMachine->execute(new CigarettePurchaseTransaction($itemCount, $amount));

            $this->printPurchaseSummary($output, $purchase);
            $this->printChangeInfo($output, $purchase);
        } catch (InsufficientAmountException $exception) {
            $output->writeln($exception->getMessage());
        }
    }

    private function printPurchaseSummary(OutputInterface $output, PurchasedItemInterface $purchase): void
    {
        $output->writeln(sprintf(
                self::PURCHASE_MSG,
                $purchase->getItemQuantity(),
                $purchase->getTotalAmount(),
                CigarettePurchaseTransaction::ITEM_PRICE)
        );
    }

    private function printChangeInfo(OutputInterface $output, PurchasedItemInterface $purchase): void
    {
        $output->writeln(self::CHANGE_MSG);

        $table = new Table($output);
        $table
            ->setHeaders(array('Coins', 'Count'))
            ->setRows($purchase->getChange()->toNative())
        ;
        $table->render();
    }
}
