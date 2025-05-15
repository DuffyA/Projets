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
}
