<?php

use Spatie\DataTransferObject\DataTransferObject;

class PageDTO extends DataTransferObject
{
    public function __construct(
        public PageId $pageId,
        public string $url,
        public string $title,
    )
    {}
}