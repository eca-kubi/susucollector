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

#[Entity(repositoryClass: 'AdministratorRepository')]
class Administrator
{
    #[ID]
    #[Column(name: 'id', type: Types::INTEGER)]
    #[GeneratedValue]
    private int $id;

    #[OneToOne(targetEntity: 'UserProfile', cascade: ["persist"])]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id', unique: true)]
    private UserProfile $userProfile;

    #[ManyToOne(targetEntity: 'Branch', inversedBy: 'administrators')]
    #[JoinColumn(name: 'branch_id', referencedColumnName: 'id')]
    private Branch $branch;

    #[OneToMany(mappedBy: 'administrator',targetEntity: 'Transaction')]
    private ArrayCollection $transactions;

    public function __construct(Branch $branch, UserProfile $user)
    {
        $this->branch = $branch;
        $this->userProfile = $user;
        $this->userProfile->setIsAdmin(true);
        $this->transactions = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getTransactions(): ArrayCollection
    {
        return $this->transactions;
    }

    public function assignBranch(Branch $branch): void
    {
        $this->setBranch($branch);
    }

    /**
     * @param Branch $branch
     */
    public function setBranch(Branch $branch): void
    {
        $this->branch = $branch;
    }

    /**
     * @return Branch
     */
    public function getBranch(): Branch
    {
        return $this->branch;
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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

    public function addToTransactions(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }
}