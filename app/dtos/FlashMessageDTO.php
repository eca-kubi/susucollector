<?php

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class FlashMessageDTO extends DataTransferObject
{
    public function __construct(
        public PageId           $pageId,
        public FlashMessageType $type,
        public string           $message
    )
    {
    }
}