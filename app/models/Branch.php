<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity(repositoryClass: 'BranchRepository')]
class Branch
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'id', type: Types::INTEGER)]
    private int $id;

    #[Column(name: 'name', type: Types::STRING, length: 50)]
    private string $name;

    /**
     * @var Collection|Administrator[]
     */
    #[OneToMany(mappedBy: 'branch', targetEntity: 'Administrator')]
    private Collection $administrators;

    /**
     * @var Collection|Agent[]
     */
    #[OneToMany(mappedBy: 'branch', targetEntity: 'Agent')]
    private Collection $agents;

    /**
     * @var Collection|Account[]
     */
    #[OneToMany(mappedBy: 'branch', targetEntity: 'Account')]
    private Collection $accounts;

    public function __construct()
    {
        $this->administrators = new ArrayCollection();
        $this->agents = new ArrayCollection();
        $this->accounts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getAccounts(): Collection
    {
        return $this->accounts;
    }

    public function getAgents(): Collection
    {
        return $this->agents;
    }


    public function getAdministrators(): Collection
    {
        return $this->administrators;
    }

    public function addToAdministrators(Administrator $administrator): void
    {
        $this->administrators[] = $administrator;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function addToAgents(Agent $agent): void
    {
        $this->agents[] = $agent;
    }

    public function addToAccounts(Account $account): void
    {
        $this->accounts[] = $account;
    }
}