<?php

class UserAccountManager
{
    /**
     */
    public static function authenticate(string $email, string $password): bool{

        $user =  UserProfileRepository::instance()->findOneBy(['email' => trim($email)]);
        if ($user) {
            return password_verify($password, $user->getPassword());
        }
        return false;
    }

    public static function isUserAnAdmin(string $email): bool
    {
        $userType = UserProfileRepository::instance()->findOneBy(['email' => $email])?->getUserType();
        return $userType == UserRole::ADMIN;
    }

    public static function hasUserLoggedIn(): bool | null
    {
        return SessionManager::getInstance()->get('userHasLoggedIn');
    }

    public static function saveLoginSession(string $email): void
    {
        $session = SessionManager::getInstance();
        $session->set('userHasLoggedIn', true);
        $session->set('email', $email);
    }

    public static function getCurrentUser(): ?UserProfile
    {
        return UserProfileRepository::instance()->findOneBy(['email' => SessionManager::getInstance()->get('email')]);
    }


}