<?php

use Doctrine\Common\Collections\Collection;

class TransactionsDTO extends PageDTO
{
    /**
     * @var Transaction[] | Collection|array|int|float|null
     */
    public Collection|array|null|int|float $transactions;

    /**
     * @throws Exception
     */
    public function __construct(
        public string|int   $account,
        public DateTime     $startDate,
        public DateTime     $endDate,
        public PageId       $pageId,
        public ?UserProfile $currentUser = null,
        public string       $title = 'Transactions',
        public Client|Administrator|Agent | null $currentRole = null,
        public ?float $openingBalance = null,
        public ?float $closingBalance = null
    )
    {
        $this->currentUser = UserProfileService::getCurrentUserProfile();
        $this->transactions = TransactionRepository::instance()->getFromStartDateToEndDate($this->account, $this->startDate, $this->endDate);
        $this->currentRole = UserProfileService::getCurrentRole();
        $this->openingBalance = TransactionRepository::instance()->getOpeningInitialBalance($this->account, $this->startDate, $this->endDate);
        $this->closingBalance = TransactionRepository::instance()->getClosingFinalBalance($this->account, $this->startDate, $this->endDate);
    }
}