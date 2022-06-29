<?php

class HomeDTO extends PageDTO
{
    public function __construct(PageId $pageId = PageId::HOME, string $url=URLs::HOME, string $title='Home')
    {
        $this->pageId = $pageId;
        $this->url = $url;
        $this->title = $title;
    }
}