<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $car_id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $car_model = null;

    #[ORM\Column(length: 50)]
    private ?string $car_registration = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $car_energy = false;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $car_color = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $car_first_registration_date = null;

    #[ORM\ManyToOne(inversedBy: 'user_cars')]
    #[ORM\JoinColumn(name: 'car_user', referencedColumnName: 'user_id', nullable: false)]
    private ?User $car_user = null;

    #[ORM\ManyToOne(inversedBy: 'carBrand_cars')]
    #[ORM\JoinColumn(name: 'car_brand', referencedColumnName: 'carBrand_id', nullable: false)]
    private ?CarBrand $car_brand = null;

    /**
     * @var Collection<int, Journey>
     */
    #[ORM\OneToMany(targetEntity: Journey::class, mappedBy: 'journey_car')]
    private Collection $car_journeys;

    public function __construct()
    {
        $this->car_journeys = new ArrayCollection();
    }

    public function getCarId(): ?int
    {
        return $this->car_id;
    }

    public function getCarModel(): ?string
    {
        return $this->car_model;
    }

    public function setCarModel(?string $car_model): static
    {
        $this->car_model = $car_model;

        return $this;
    }

    public function getCarRegistration(): ?string
    {
        return $this->car_registration;
    }

    public function setCarRegistration(string $car_registration): static
    {
        $this->car_registration = $car_registration;

        return $this;
    }

    public function isCarEnergy(): ?bool
    {
        return $this->car_energy;
    }

    public function setCarEnergy(bool $car_energy): static
    {
        $this->car_energy = $car_energy;

        return $this;
    }

    public function getCarColor(): ?string
    {
        return $this->car_color;
    }

    public function setCarColor(?string $car_color): static
    {
        $this->car_color = $car_color;

        return $this;
    }

    public function getCarFirstRegistrationDate(): ?\DateTime
    {
        return $this->car_first_registration_date;
    }

    public function setCarFirstRegistrationDate(\DateTime $car_first_registration_date): static
    {
        $this->car_first_registration_date = $car_first_registration_date;

        return $this;
    }

    public function getCarUser(): ?User
    {
        return $this->car_user;
    }

    public function setCarUser(?User $car_user): static
    {
        $this->car_user = $car_user;

        return $this;
    }

    public function getCarBrand(): ?CarBrand
    {
        return $this->car_brand;
    }

    public function setCarBrand(?CarBrand $car_brand): static
    {
        $this->car_brand = $car_brand;

        return $this;
    }

    /**
     * @return Collection<int, Journey>
     */
    public function getCarJourneys(): Collection
    {
        return $this->car_journeys;
    }

    public function addCarJourney(Journey $carJourney): static
    {
        if (!$this->car_journeys->contains($carJourney)) {
            $this->car_journeys->add($carJourney);
            $carJourney->setJourneyCar($this);
        }

        return $this;
    }

    public function removeCarJourney(Journey $carJourney): static
    {
        if ($this->car_journeys->removeElement($carJourney)) {
            // set the owning side to null (unless already changed)
            if ($carJourney->getJourneyCar() === $this) {
                $carJourney->setJourneyCar(null);
            }
        }

        return $this;
    }
}
