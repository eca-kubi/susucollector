<?php

class AgentLoginDTO extends PageDTO
{
    public string $title = 'Agent Login';

    public PageId $pageId = PageId::AGENT_LOGIN;

    public string $url = '';

    public string $email = '';

    public string $password = '';

    public function __construct()
    {
        parent::__construct();
    }
}