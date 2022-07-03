<?php

use Doctrine\Common\Collections\Collection;

class TransactionsDTO extends PageDTO
{
    /**
     * @var Transaction[] | Collection
     */
    public ?Collection $transactions;

    public function __construct(
        public string|int                        $account,
        public DateTime $startDate,
        public DateTime $endDate,
        public PageId                          $pageId,
        public ?UserProfile                    $currentUser = null,
        public string                          $title = 'Transactions',
    )
    {
        $this->currentUser = UserProfileService::getCurrentUserProfile();
        $this->transactions = TransactionRepository::instance()->getFromStartDateToEndDate($this->account, $this->startDate, $this->endDate);
    }
}