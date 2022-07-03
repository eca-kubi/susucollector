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

#[Entity(repositoryClass: 'AccountRepository')]
class Account
{
    #[ID]
    #[Column(name: 'id', type: Types::INTEGER)]
    #[GeneratedValue]
    private int $id;

    //#[OneToOne(targetEntity: 'Client', cascade: ["persist"])]
    //#[JoinColumn(name: 'client_id', referencedColumnName: 'id', unique: true)]
    #[ManyToOne(targetEntity: 'Client', inversedBy: 'accounts')]
    private Client $owner;

    #[ManyToOne(targetEntity: 'Agent', inversedBy: 'accounts')]
    private Agent $agent;

    #[ManyToOne(targetEntity: 'Branch', inversedBy: 'accounts')]
    #[JoinColumn(name: 'branch_id', referencedColumnName: 'id')]
    private Branch $branch;

    #[Column(name: 'account_number')]
    private string $account_number;

    #[Column(name: 'balance')]
    private float $balance;

    /**
     * @var Collection |Transaction[]
     */
    #[OneToMany(mappedBy: 'account', targetEntity: 'Transaction')]
    private Collection $transactions;

    #[Column(name: 'date_created', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private DateTime $date_created;

    public function __construct(Agent $agent, Branch $branch, Client $client)
    {
        $this->agent = $agent;
        $this->branch = $branch;
        $this->owner = $client;
        $agent->addToAccounts($this);
        $branch->addToAccounts($this);
        $client->addToAccounts($this);
        $this->transactions = new ArrayCollection();
    }

    public function addToTransactions(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    /**
     * @return Collection | Transaction[]
     */
    public function getTransactions(): Collection | array
    {
        return $this->transactions;
    }

    /**
     * @param DateTime $date_created
     */
    public function setDateCreated(DateTime $date_created): void
    {
        $this->date_created = $date_created;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated(): DateTime
    {
        return $this->date_created;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance(float $balance): void
    {
        $this->balance = $this->getBalance() + $balance;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Client
     */
    public function getOwner(): Client
    {
        return $this->owner;
    }

    /**
     * @param Client $owner
     */
    public function setOwner(Client $owner): void
    {
        $this->owner = $owner;

        // Assign account to client
        $this->owner->addToAccounts($this);
    }


    /**
     * @param DateTimeImmutable|null $createdAt
     */
    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Agent
     */
    public function getAgent(): Agent
    {
        return $this->agent;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->account_number;
    }

    /**
     * @return Branch
     */
    public function getBranch(): Branch
    {
        return $this->branch;
    }

    /**
     * @param string $account_number
     */
    public function setAccountNumber(string $account_number): void
    {
        $this->account_number = $account_number;
    }

    /**
     * @param Agent $agent
     */
    public function setAgent(Agent $agent): void
    {
        $this->agent = $agent;

        // Assign to agent
        $this->agent->addToAccounts($this);
    }

    /**
     * @param Branch $branch
     */
    public function setBranch(Branch $branch): void
    {
        $this->branch = $branch;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}