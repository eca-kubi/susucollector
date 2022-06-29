<?php

class ErrorsDTO extends PageDTO
{
    const EMPLOYEE_LOGIN_URL = URLs::EMPLOYEE_LOGIN;
    const ADMIN_LOGIN_URL = URLs::ADMIN_LOGIN;

    public function __construct(
        public PageId $pageId = PageId::ERRORS,
        public string $title = '',
        public string $message = ''
    )
    {}
}