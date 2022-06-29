<?php

class ErrorsDTO extends PageDTO
{
    public function __construct(
        public PageId $pageId = PageId::ERRORS,
        public string $title = '',
        public string $message = ''
    )
    {}
}