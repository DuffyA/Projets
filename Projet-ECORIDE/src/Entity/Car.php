<?php

namespace App\Entity;

use App\Repository\CarRepository;
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
}
