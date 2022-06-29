<?php

class LoginDTO extends PageDTO
{
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const DUMMY_PASSWORD = 'rasmuslerdorf';
    const DUMMY_USER = 'ecakubi@gmail.com';

    public function __construct(
         public string $url,
         public string $title = 'Agent Login',
         public PageId $pageId = PageId::AGENT_LOGIN,
         public string  $email = self::DUMMY_USER,
         public string  $password = self::DUMMY_PASSWORD,
    )
    {}
}