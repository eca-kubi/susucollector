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

#[Entity(repositoryClass: 'TransactionRepository')]
class Transaction
{
    #[ID]
    #[Column(name: 'id', type: Types::INTEGER)]
    #[GeneratedValue]
    private int $id;

    #[ManyToOne(targetEntity: 'Agent', inversedBy: 'transactions')]
    #[JoinColumn(name: 'agent_id', referencedColumnName: 'id')]
    private Agent $agent;

    #[ManyToOne(targetEntity: 'Account', inversedBy: 'transactions')]
    #[JoinColumn(name: 'account_id', referencedColumnName: 'id')]
    private Account $account;

    #[ManyToOne(targetEntity: 'Administrator', inversedBy: 'transactions')]
    #[JoinColumn(name: 'administrator_id', referencedColumnName: 'id')]
    private Administrator $approved_by;

    #[Column(name: 'type')]
    private string $type;

    #[Column(name: 'amount_deposited')]
    private float $amountDeposited;

    #[Column(name: 'amount_withdrawn')]
    private float $amountWithdrawn;

    #[Column(name: 'date_created', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private DateTime $date_created;

    public function assignToAgent(Agent $agent): void
    {
        $agent->addToTransactions($this);
    }

    public function assignToAdministrator(Administrator $administrator): void
    {
        $administrator->addToTransactions($this);
    }

    /**
     * @return float
     */
    public function getAmountDeposited(): float
    {
        return $this->amountDeposited;
    }

    /**
     * @param float $amountDeposited
     */
    public function setAmountDeposited(float $amountDeposited): void
    {
        $this->amountDeposited = $amountDeposited;
    }

    /**
     * @param float $amountWithdrawn
     */
    public function setAmountWithdrawn(float $amountWithdrawn): void
    {
        $this->amountWithdrawn = $amountWithdrawn;
    }

    /**
     * @return float
     */
    public function getAmountWithdrawn(): float
    {
        return $this->amountWithdrawn;
    }

    /**
     * @return Administrator
     */
    public function getApprovedBy(): Administrator
    {
        return $this->approved_by;
    }

    /**
     * @param Administrator $approved_by
     */
    public function setApprovedBy(Administrator $approved_by): void
    {
        $this->approved_by = $approved_by;
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated(): DateTime
    {
        return $this->date_created;
    }

    /**
     * @param Account $account
     */
    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }

    /**
     * @param DateTime $date_created
     */
    public function setDateCreated(DateTime $date_created): void
    {
        $this->date_created = $date_created;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Agent
     */
    public function getAgent(): Agent
    {
        return $this->agent;
    }

    /**
     * @param Agent $agent
     */
    public function setAgent(Agent $agent): void
    {
        $this->agent = $agent;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function assignToAccount(Account $account): void
    {
        $account->addToTransactions($this);
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}