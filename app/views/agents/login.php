<?php
// Agents::Login
/** @var DataTransferObject $dto */

use Spatie\DataTransferObject\DataTransferObject;

$dto->pageId = PageId::AGENT_LOGIN;
include APP_ROOT . "/templates/login-page-template.php";


