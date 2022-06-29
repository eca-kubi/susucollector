<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;

#[Entity(repositoryClass: 'AgentRepository')]
class Agent
{
    #[ID]
    #[Column(name: 'id', type: Types::INTEGER)]
    #[GeneratedValue]
    private int $id;

    #[OneToOne(targetEntity: 'UserProfile')]
    private UserProfile $userProfile;

    #[ManyToOne(targetEntity: 'Branch', inversedBy: 'agents')]
    #[JoinColumn(name: 'branch_id', referencedColumnName: 'id')]
    private Branch $branch;

    /**
     * @var Account[] | Collection
     */
    #[OneToMany(mappedBy: 'agent', targetEntity: 'Account')]
    #[JoinColumn(name: 'account_id', referencedColumnName: 'id')]
    private Collection $accounts;

    /**
     * @var Transaction[] | Collection
     */
    #[OneToMany(mappedBy: 'agent', targetEntity: 'Transaction')]
    #[JoinColumn(name: 'transaction_id', referencedColumnName: 'id')]
    private Collection $transactions;

    public function __construct(Branch $branch, UserProfile $user)
    {
        $this->branch = $branch;
        $branch->addToAgents($this);
        $this->userProfile = $user;
        $this->userProfile->setIsAgent(true);
        $this->accounts = new ArrayCollection();
        $this->transactions = new ArrayCollection();
    }

    /**
     * @return Branch
     */
    public function getBranch(): Branch
    {
        return $this->branch;
    }

    /**
     * @param Branch $branch
     */
    public function setBranch(Branch $branch): void
    {
        $this->branch = $branch;
    }

    /**
     * @return Collection | Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addToTransactions(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Account[]
     */
    public function getAccounts(): Collection
    {
        return $this->accounts;
    }

    /**
     * @return UserProfile
     */
    public function getUserProfile(): UserProfile
    {
        return $this->userProfile;
    }

    /**
     * @param UserProfile $userProfile
     */
    public function setUserProfile(UserProfile $userProfile): void
    {
        $this->userProfile = $userProfile;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function addToAccounts(Account $account): void
    {
        $this->accounts[] = $account;
    }
}