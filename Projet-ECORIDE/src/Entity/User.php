<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['user_email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column(length: 180)]
    private ?string $user_email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $user_roles = [];

    /**
     * @var ?string The hashed password
     */
    #[ORM\Column]
    private ?string $user_password = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $user_firstname = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $user_surname = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $user_phone = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $user_address = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $user_birthdate = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $user_photo = null;

    #[ORM\Column(length: 50)]
    private ?string $user_pseudo = null;

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function getUserEmail(): ?string
    {
        return $this->user_email;
    }

    public function setUserEmail(string $user_email): static
    {
        $this->user_email = $user_email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->user_email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $user_roles = $this->user_roles;
        // guarantee every user at least has ROLE_USER
        $user_roles[] = 'ROLE_USER';

        return array_unique($user_roles);
    }

    /**
     * @param list<string> $user_roles
     */
    public function setRoles(array $user_roles): static
    {
        $this->user_roles = $user_roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getUserPassword(): ?string
    {
        return $this->user_password;
    }

    public function setUserPassword(string $user_password): static
    {
        $this->user_password = $user_password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserFirstname(): ?string
    {
        return $this->user_firstname;
    }

    public function setUserFirstname(?string $user_firstname): static
    {
        $this->user_firstname = $user_firstname;

        return $this;
    }

    public function getUserSurname(): ?string
    {
        return $this->user_surname;
    }

    public function setUserSurname(?string $user_surname): static
    {
        $this->user_surname = $user_surname;

        return $this;
    }

    public function getUserPhone(): ?string
    {
        return $this->user_phone;
    }

    public function setUserPhone(?string $user_phone): static
    {
        $this->user_phone = $user_phone;

        return $this;
    }

    public function getUserAddress(): ?string
    {
        return $this->user_address;
    }

    public function setUserAddress(?string $user_address): static
    {
        $this->user_address = $user_address;

        return $this;
    }

    public function getUserBirthdate(): ?\DateTime
    {
        return $this->user_birthdate;
    }

    public function setUserBirthdate(?\DateTime $user_birthdate): static
    {
        $this->user_birthdate = $user_birthdate;

        return $this;
    }

    public function getUserPhoto(): null
    {
        return $this->user_photo;
    }

    public function setUserPhoto($user_photo): static
    {
        $this->user_photo = $user_photo;

        return $this;
    }

    public function getUserPseudo(): ?string
    {
        return $this->user_pseudo;
    }

    public function setUserPseudo(string $user_pseudo): static
    {
        $this->user_pseudo = $user_pseudo;

        return $this;
    }

}
