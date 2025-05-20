<?php

namespace App\Entity;

use App\Repository\JourneyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JourneyRepository::class)]
class Journey
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $journey_id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $journey_departure_date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $journey_departure_time = null;

    #[ORM\Column(length: 50)]
    private ?string $journey_departure_place = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $journey_arrival_date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $journey_arrival_time = null;

    #[ORM\Column(length: 50)]
    private ?string $journey_arrival_place = null;

    #[ORM\Column(length: 50)]
    private ?string $journey_status = null;

    #[ORM\Column]
    private ?int $journey_seats = null;

    #[ORM\Column]
    private ?float $journey_price = null;

    #[ORM\ManyToOne(inversedBy: 'car_journeys')]
    #[ORM\JoinColumn(name: 'journey_car', referencedColumnName: 'car_id', nullable: false)]
    private ?Car $journey_car = null;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'review_journey')]
    private Collection $journey_reviews;

    #[ORM\ManyToOne(inversedBy: 'user_Djourneys')]
    #[ORM\JoinColumn(name: 'journey_driver', referencedColumnName: 'user_id', nullable: false)]
    private ?User $journey_driver = null;

    public function __construct()
    {
        $this->journey_reviews = new ArrayCollection();
    }

    public function getJourneyId(): ?int
    {
        return $this->journey_id;
    }

    public function getJourneyDepartureDate(): ?\DateTime
    {
        return $this->journey_departure_date;
    }

    public function setJourneyDepartureDate(\DateTime $journey_departure_date): static
    {
        $this->journey_departure_date = $journey_departure_date;

        return $this;
    }

    public function getJourneyDepartureTime(): ?\DateTime
    {
        return $this->journey_departure_time;
    }

    public function setJourneyDepartureTime(\DateTime $journey_departure_time): static
    {
        $this->journey_departure_time = $journey_departure_time;

        return $this;
    }

    public function getJourneyDeparturePlace(): ?string
    {
        return $this->journey_departure_place;
    }

    public function setJourneyDeparturePlace(string $journey_departure_place): static
    {
        $this->journey_departure_place = $journey_departure_place;

        return $this;
    }

    public function getJourneyArrivalDate(): ?\DateTime
    {
        return $this->journey_arrival_date;
    }

    public function setJourneyArrivalDate(\DateTime $journey_arrival_date): static
    {
        $this->journey_arrival_date = $journey_arrival_date;

        return $this;
    }

    public function getJourneyArrivalTime(): ?\DateTime
    {
        return $this->journey_arrival_time;
    }

    public function setJourneyArrivalTime(\DateTime $journey_arrival_time): static
    {
        $this->journey_arrival_time = $journey_arrival_time;

        return $this;
    }

    public function getJourneyArrivalPlace(): ?string
    {
        return $this->journey_arrival_place;
    }

    public function setJourneyArrivalPlace(string $journey_arrival_place): static
    {
        $this->journey_arrival_place = $journey_arrival_place;

        return $this;
    }

    public function getJourneyStatus(): ?string
    {
        return $this->journey_status;
    }

    public function setJourneyStatus(string $journey_status): static
    {
        $this->journey_status = $journey_status;

        return $this;
    }

    public function getJourneySeats(): ?int
    {
        return $this->journey_seats;
    }

    public function setJourneySeats(int $journey_seats): static
    {
        $this->journey_seats = $journey_seats;

        return $this;
    }

    public function getJourneyPrice(): ?float
    {
        return $this->journey_price;
    }

    public function setJourneyPrice(float $journey_price): static
    {
        $this->journey_price = $journey_price;

        return $this;
    }

    public function getJourneyCar(): ?Car
    {
        return $this->journey_car;
    }

    public function setJourneyCar(?Car $journey_car): static
    {
        $this->journey_car = $journey_car;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getJourneyReviews(): Collection
    {
        return $this->journey_reviews;
    }

    public function addJourneyReview(Review $journeyReview): static
    {
        if (!$this->journey_reviews->contains($journeyReview)) {
            $this->journey_reviews->add($journeyReview);
            $journeyReview->setReviewJourney($this);
        }

        return $this;
    }

    public function removeJourneyReview(Review $journeyReview): static
    {
        if ($this->journey_reviews->removeElement($journeyReview)) {
            // set the owning side to null (unless already changed)
            if ($journeyReview->getReviewJourney() === $this) {
                $journeyReview->setReviewJourney(null);
            }
        }

        return $this;
    }

    public function getJourneyDriver(): ?User
    {
        return $this->journey_driver;
    }

    public function setJourneyDriver(?User $journey_driver): static
    {
        $this->journey_driver = $journey_driver;

        return $this;
    }
}
