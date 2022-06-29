<?php

class Accounts extends Controller
{
    public function transactions(string $account_id)
    {
        $currentUser = UserProfileService::getCurrentUserProfile();
        $this->dto = new AccountTransactionsDTO();
    }
}