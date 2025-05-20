<?php

namespace App\Entity;

use App\Repository\CarBrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Car>
     */
    #[ORM\OneToMany(targetEntity: Car::class, mappedBy: 'car_brand')]
    private Collection $carBrand_cars;

    public function __construct()
    {
        $this->carBrand_cars = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Car>
     */
    public function getCarBrandCars(): Collection
    {
        return $this->carBrand_cars;
    }

    public function addCarBrandCar(Car $carBrandCar): static
    {
        if (!$this->carBrand_cars->contains($carBrandCar)) {
            $this->carBrand_cars->add($carBrandCar);
            $carBrandCar->setCarBrand($this);
        }

        return $this;
    }

    public function removeCarBrandCar(Car $carBrandCar): static
    {
        if ($this->carBrand_cars->removeElement($carBrandCar)) {
            // set the owning side to null (unless already changed)
            if ($carBrandCar->getCarBrand() === $this) {
                $carBrandCar->setCarBrand(null);
            }
        }

        return $this;
    }
}
