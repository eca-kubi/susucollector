<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;

#[Entity(repositoryClass: 'ClientRepository')]
class Client
{
    #[ID]
    #[Column(name: 'id', type: Types::INTEGER)]
    #[GeneratedValue]
    private int $id;

    #[OneToOne(targetEntity: 'UserProfile', cascade: ["persist"])]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id', unique: true)]
    private UserProfile $userProfile;

    /**
     * @var Collection|Account[]
     */
    #[OneToMany(mappedBy: 'owner', targetEntity: 'Account')]
    #[JoinColumn(name: 'account_id', referencedColumnName: 'id')]
    private Collection $accounts;

    public function __construct(UserProfile $user)
    {
        $this->userProfile = $user;
        $this->userProfile->setIsClient(true);
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

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function addToAccounts(Account $account): void
    {
        $this->accounts[] = $account;
    }
}