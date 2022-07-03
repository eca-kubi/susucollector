<?php

class Transactions extends Controller
{
    /**
     * @throws Exception
     */
    public function index(string | int | null $account_id = null, ?string $startDate = null, ?string $endDate = null)
    {
        Helpers::requiresLogin(URLs::HOME);
        if (is_null($account_id) || is_null($startDate) || is_null($endDate)){
            Helpers::redirect('errors', 'index', ErrorCodes::BAD_REQUEST->value);
        }
        $start= new DateTime($startDate);
        $end = new DateTime($endDate);
        $this->dto = new TransactionsDTO($account_id, $start, $end, PageId::TRANSACTIONS_INDEX);
        $this->pageId = PageId::TRANSACTIONS_INDEX;
    }
}