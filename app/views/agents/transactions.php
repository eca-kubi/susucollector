<?php
// Agents::Transactions
/** @var DataTransferObject $dto */

use Spatie\DataTransferObject\DataTransferObject;

$dto->pageId = PageId::AGENTS_TRANSACTIONS;
include APP_ROOT . "/templates/transactions.php";
