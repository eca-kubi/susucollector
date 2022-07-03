<?php

class UserProfileService
{
    private UserProfileRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserProfileRepository();
    }

    public function authenticate(string $email, string $password, UserRole $currentRole) : bool
    {
        $user = $this->userRepo->findOneByCriteria(['email'=>$email]);
        if ($user) {
            $verified = password_verify($password, $user->getPassword());
            if ($verified)
                $this->saveLoginSession($user->getEmail(), $currentRole);
            return $verified;
        }
        return false;
    }

    public function saveLoginSession(string $email, UserRole $current_role): void
    {
        $session = SessionManager::getInstance();
        $session->set(SessionManager::SESSION_KEY_USER_HAS_LOGGED_IN, true);
        $session->set(SessionManager::SESSION_KEY_CURRENT_USER, $email);
        $session->set(SessionManager::SESSION_KEY_CURRENT_ROLE, serialize($current_role));
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

    public static function getCurrentRole() : Agent | Administrator | null
    {
        $currentRole =   unserialize(SessionManager::getInstance()->get(SessionManager::SESSION_KEY_CURRENT_ROLE));
        if(self::hasUserLoggedIn()) {
            return match ($currentRole) {
                UserRole::AGENT => AgentRepository::instance()->findOneByUserProfileId(self::getCurrentUserProfile()->getId()),
                UserRole::ADMIN => AdministratorRepository::instance()->findOneByUserProfileId(self::getCurrentUserProfile()->getId()),
            };
        }
        return null;
    }
}