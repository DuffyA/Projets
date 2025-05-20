<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $review_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $review_comment = null;

    #[ORM\Column]
    private ?int $review_note = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $review_status = false;

    #[ORM\ManyToOne(inversedBy: 'user_Wreviews')]
    #[ORM\JoinColumn(name: 'review_writer', referencedColumnName: 'user_id', nullable: false)]
    private ?User $review_writer = null;

    #[ORM\ManyToOne(inversedBy: 'User_reviews')]
    #[ORM\JoinColumn(name: 'review_target', referencedColumnName: 'user_id', nullable: false)]
    private ?User $review_target = null;

    #[ORM\ManyToOne(inversedBy: 'journey_reviews')]
    #[ORM\JoinColumn(name: 'review_journey', referencedColumnName: 'journey_id',nullable: false)]
    private ?Journey $review_journey = null;

    public function getReviewId(): ?int
    {
        return $this->review_id;
    }

    public function getReviewComment(): ?string
    {
        return $this->review_comment;
    }

    public function setReviewComment(?string $review_comment): static
    {
        $this->review_comment = $review_comment;

        return $this;
    }

    public function getReviewNote(): ?int
    {
        return $this->review_note;
    }

    public function setReviewNote(int $review_note): static
    {
        $this->review_note = $review_note;

        return $this;
    }

    public function isReviewStatus(): ?bool
    {
        return $this->review_status;
    }

    public function setReviewStatus(bool $review_status): static
    {
        $this->review_status = $review_status;

        return $this;
    }

    public function getReviewWriter(): ?User
    {
        return $this->review_writer;
    }

    public function setReviewWriter(?User $review_writer): static
    {
        $this->review_writer = $review_writer;

        return $this;
    }

    public function getReviewTarget(): ?User
    {
        return $this->review_target;
    }

    public function setReviewTarget(?User $review_target): static
    {
        $this->review_target = $review_target;

        return $this;
    }

    public function getReviewJourney(): ?Journey
    {
        return $this->review_journey;
    }

    public function setReviewJourney(?Journey $review_journey): static
    {
        $this->review_journey = $review_journey;

        return $this;
    }
}
