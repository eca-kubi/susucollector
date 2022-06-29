<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;

#[Entity(repositoryClass: 'UserProfileRepository')]
class UserProfile
{
    #[ID]
    #[Column(name: 'id', type: Types::INTEGER)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: 'first_name', type: Types::STRING, length: 25)]
    private string $firstName;

    #[Column(name: 'last_name', type: Types::STRING, length: 50)]
    private string $lastName;

    #[Column(name: 'password', type: Types::STRING, length: 500)]
    private string $password;

    #[Column(name: 'birth_date')]
    private DateTime $birthDate;

    #[Column(name: 'email', type: Types::STRING, length: 200)]
    private string $email;

    #[Column(name: 'phone', type: Types::STRING, length: 15)]
    private string $phone;

    #[Column(name: 'is_admin')]
    private bool $isAdmin;

    #[Column(name: 'is_client')]
    private bool $isClient;

    #[Column(name: 'is_agent')]
    private bool $isAgent;

    #[Column(name: 'is_super_admin')]
    private bool $isSuperAdmin;

    #[Column(name: 'created_at', type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    /**
     * @param DateTimeImmutable|null $createdAt
     */
    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param bool $isAgent
     */
    public function setIsAgent(bool $isAgent): void
    {
        $this->isAgent = $isAgent;
    }

    /**
     * @return bool
     */
    public function isAgent(): bool
    {
        return $this->isAgent;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * @param bool $isAdmin
     */
    public function setIsAdmin(?bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * @param bool $isSuperAdmin
     */
    public function setIsSuperAdmin(bool $isSuperAdmin): void
    {
        $this->isSuperAdmin = $isSuperAdmin;
    }

    /**
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->isSuperAdmin;
    }

    /**
     * @return bool
     */
    public function isClient(): bool
    {
        return $this->isClient;
    }

    /**
     * @param bool $isClient
     */
    public function setIsClient(bool $isClient): void
    {
        $this->isClient = $isClient;
    }

    /**
     * @return DateTime
     */
    public function getBirthDate(): DateTime
    {
        return $this->birth_date;
    }

    /**
     * @param DateTime $birth_date
     */
    public function setBirthDate(DateTime $birth_date): void
    {
        $this->birth_date = $birth_date;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}