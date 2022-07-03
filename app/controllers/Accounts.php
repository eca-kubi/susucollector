<?php

class Accounts extends Controller
{
    public function transactions(string| int $account_id = "")
    {
        Helpers::requiresLogin();
        $currentUser = UserProfileService::getCurrentUserProfile();
        if (!$account_id || !AccountRepository::instance()->findOneById($account_id)){
            if ($currentUser->isAgent()){
                FlashMessageManager::setFlash(PageId::AGENT_DASHBOARD, FlashMessageType::DANGER,
                    'A valid account is required.');
                Helpers::redirectUrl(URLs::AGENTS_DASHBOARD);
            }
            FlashMessageManager::setFlash();
        }
        $this->dto = new TransactionsDTO();
    }
}