<?php

class UserProfileService
{
    private UserProfileRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserProfileRepository();
    }

    public function authenticate(string $email, string $password) : bool
    {
        $user = $this->userRepo->findOneByCriteria(['email'=>$email]);
        if ($user) {
            $verified = password_verify($password, $user->getPassword());
            if ($verified)
                $this->saveLoginSession($user->getEmail());
            return $verified;
        }
        return false;
    }

    public function saveLoginSession(string $email): void
    {
        $session = SessionManager::getInstance();
        $session->set(SessionManager::SESSION_KEY_USER_HAS_LOGGED_IN, true);
        $session->set(SessionManager::SESSION_KEY_CURRENT_USER, $email);
    }

    public static function getCurrentUserProfile(): ?UserProfile
    {
        $userRepo = new UserProfileRepository();
        return $userRepo->findOneByCriteria(['email' => SessionManager::getInstance()->get(SessionManager::SESSION_KEY_CURRENT_USER)]);
    }

    public static function hasUserLoggedIn(): bool | null
    {
        return SessionManager::getInstance()->get(SessionManager::SESSION_KEY_USER_HAS_LOGGED_IN);
    }
}