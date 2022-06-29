<?php

class AgentDashboardDTO extends PageDTO
{
    private AgentRepository $agentRepository;

    public function __construct(
        public UserProfile         $currentUser,
        public Agent $agent,
        public string              $title = 'Agent Dashboard',
        public PageId              $pageId = PageId::AGENT_DASHBOARD
    )
    {
        $this->currentUser = UserProfileService::getCurrentUserProfile();
        $this->agentRepository = new AgentRepository();
        $this->agent = $this->agentRepository->findOneByUserProfileId($this->currentUser->getId());
    }
}