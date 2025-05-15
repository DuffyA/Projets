<?php

namespace App\Entity;

use App\Repository\CarBrandRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarBrandRepository::class)]
class CarBrand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $carBrand_id = null;

    #[ORM\Column(length: 50)]
    private ?string $carBrand_label = null;

    public function getCarBrandId(): ?int
    {
        return $this->carBrand_id;
    }

    public function getCarBrandLabel(): ?string
    {
        return $this->carBrand_label;
    }

    public function setCarBrandLabel(string $carBrand_label): static
    {
        $this->carBrand_label = $carBrand_label;

        return $this;
    }
}
