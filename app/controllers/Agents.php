<?php

class Agents extends Controller
{

    public function index()
    {

    }

    public function login()
    {
        $this->pageId = PageId::AGENT_LOGIN;
        $this->dto = new LoginDTO(URLs::AGENT_LOGIN);
        $userProfileService = new UserProfileService();
        if($this->request->isMethod('POST')) {
            $success = $userProfileService->authenticate($this->request->get('email'), $this->request->get('password'));
            $currentUser = UserProfileService::getCurrentUserProfile();
            if ($success){
                if (!$currentUser->isAgent()) {
                    FlashMessageManager::setFlash(PageId::HOME, FlashMessageType::DANGER,
                        'The agent role has not been assigned to this account (' . $currentUser->getEmail() . ')');
                    Helpers::redirect('home', 'index');
                }
                Helpers::redirect('agents', 'dashboard');
            } else {
                FlashMessageManager::setFlash($this->pageId, FlashMessageType::DANGER, 'Incorrect username or password');
                Helpers::redirect('agents', 'login');
            }
        }
        $this->view('agents/login', $this->dto);
    }

    public function dashboard()
    {
        if (!UserProfileService::hasUserLoggedIn()) {
            Helpers::redirect('agents', 'login');
        }
        $this->pageId = PageId::AGENT_DASHBOARD;
        $currentUserProfile = UserProfileService::getCurrentUserProfile();
        $agent = AgentRepository::instance()->findOneByUserProfileId($currentUserProfile->getId());
        $this->dto = new AgentDashboardDTO(currentUser: $currentUserProfile, agent: $agent);
        $this->view('agents/dashboard', $this->dto);
    }
}