<?php

class Agents extends Controller
{

    public function index()
    {

    }

    public function login()
    {
        $this->pageId = PageId::AGENT_LOGIN;
        $this->dto = new LoginDTO(URLs::AGENTS_LOGIN);
        $userProfileService = new UserProfileService();
        if($this->request->isMethod('POST')) {
            $success = $userProfileService->authenticate($this->request->get('email'), $this->request->get('password'), UserRole::AGENT);
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
        Helpers::requiresLogin(URLs::AGENTS_LOGIN);
        $this->pageId = PageId::AGENT_DASHBOARD;
        $currentUserProfile = UserProfileService::getCurrentUserProfile();
        $agent = AgentRepository::instance()->findOneByUserProfileId($currentUserProfile->getId());
        $this->dto = new AgentDashboardDTO(currentUser: $currentUserProfile, agent: $agent);
        $this->view('agents/dashboard', $this->dto);
    }

    public function transactions(string| int $account_id = "")
    {
        Helpers::requiresLogin(URLs::AGENTS_LOGIN);
        $currentUser = UserProfileService::getCurrentUserProfile();
        $agent = AgentRepository::instance()->findOneByUserProfileId($currentUser->getId());
        if (!$account_id ){
            FlashMessageManager::setFlash(PageId::AGENT_DASHBOARD, FlashMessageType::DANGER,
                'A valid account is required.');
            $this->dto = new TransactionsDTO(null);
        } else if(!AccountRepository::instance()->findOneByCriteria(['id'=> $account_id, 'agentId' => $agent->getId()])){
            FlashMessageManager::setFlash(PageId::AGENT_DASHBOARD, FlashMessageType::DANGER,
                'You can not manage this account!');
            $this->dto = new TransactionsDTO(null);
        }
    }
}