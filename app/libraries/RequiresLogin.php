<?php

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION)]
class RequiresLogin
{
    public function __construct(public string $controller=URLs::HOME, public string $method='index')
    {
        if (!UserProfileService::hasUserLoggedIn())
            Helpers::redirect($this->controller, $this->method);
    }
}