<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $user_photo = null;

    #[ORM\Column(length: 50)]
    private ?string $user_pseudo = null;

    /**
     * @var Collection<int, Car>
     */
    #[ORM\OneToMany(targetEntity: Car::class, mappedBy: 'car_user')]
    private Collection $user_cars;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'review_writer')]
    private Collection $user_Wreviews;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'review_target')]
    private Collection $User_reviews;

    /**
     * @var Collection<int, Journey>
     */
    #[ORM\OneToMany(targetEntity: Journey::class, mappedBy: 'journey_driver')]
    private Collection $user_Djourneys;

    public function __construct()
    {
        $this->user_cars = new ArrayCollection();
        $this->user_Wreviews = new ArrayCollection();
        $this->User_reviews = new ArrayCollection();
        $this->user_Djourneys = new ArrayCollection();
    }

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

    public function getUserPhoto(): string
    {
        return $this->user_photo;
    }

    public function setUserPhoto(string $user_photo): static
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

    /**
     * @return Collection<int, Car>
     */
    public function getUserCars(): Collection
    {
        return $this->user_cars;
    }

    public function addUserCar(Car $userCar): static
    {
        if (!$this->user_cars->contains($userCar)) {
            $this->user_cars->add($userCar);
            $userCar->setCarUser($this);
        }

        return $this;
    }

    public function removeUserCar(Car $userCar): static
    {
        if ($this->user_cars->removeElement($userCar)) {
            // set the owning side to null (unless already changed)
            if ($userCar->getCarUser() === $this) {
                $userCar->setCarUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getUserWreviews(): Collection
    {
        return $this->user_Wreviews;
    }

    public function addUserWreview(Review $userWreview): static
    {
        if (!$this->user_Wreviews->contains($userWreview)) {
            $this->user_Wreviews->add($userWreview);
            $userWreview->setReviewWriter($this);
        }

        return $this;
    }

    public function removeUserWreview(Review $userWreview): static
    {
        if ($this->user_Wreviews->removeElement($userWreview)) {
            // set the owning side to null (unless already changed)
            if ($userWreview->getReviewWriter() === $this) {
                $userWreview->setReviewWriter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getUserReviews(): Collection
    {
        return $this->User_reviews;
    }

    public function addUserReview(Review $userReview): static
    {
        if (!$this->User_reviews->contains($userReview)) {
            $this->User_reviews->add($userReview);
            $userReview->setReviewTarget($this);
        }

        return $this;
    }

    public function removeUserReview(Review $userReview): static
    {
        if ($this->User_reviews->removeElement($userReview)) {
            // set the owning side to null (unless already changed)
            if ($userReview->getReviewTarget() === $this) {
                $userReview->setReviewTarget(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Journey>
     */
    public function getUserDjourneys(): Collection
    {
        return $this->user_Djourneys;
    }

    public function addUserDjourney(Journey $userDjourney): static
    {
        if (!$this->user_Djourneys->contains($userDjourney)) {
            $this->user_Djourneys->add($userDjourney);
            $userDjourney->setJourneyDriver($this);
        }

        return $this;
    }

    public function removeUserDjourney(Journey $userDjourney): static
    {
        if ($this->user_Djourneys->removeElement($userDjourney)) {
            // set the owning side to null (unless already changed)
            if ($userDjourney->getJourneyDriver() === $this) {
                $userDjourney->setJourneyDriver(null);
            }
        }

        return $this;
    }

}
