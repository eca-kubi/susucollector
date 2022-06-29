<?php

class AccountTransactionsDTO extends PageDTO
{
    public function __construct(
        public UserProfile         $currentUser,
        public Account $account,
        public string              $title = 'Transactions',
        public PageId              $pageId = PageId::ACCOUNT_TRANSACTIONS
    )
    {
        $this->currentUser = UserProfileService::getCurrentUserProfile();
    }
}