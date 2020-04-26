<?php

namespace App\Entity;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AstrologerServiceRepository")
 */
class AstrologerService
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $astrologerId;

    /**
     * @ORM\Column(type="integer")
     */
    private int $serviceId;

    /**
     * @ORM\Column(type="float")
     */
    private float $cost;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Gedmo\Timestampable(on="create")
     */
    private ?DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private ?DateTime $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Astrologer", inversedBy="services", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Astrologer $astrologer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service", inversedBy="astrologerServices", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Service $service;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAstrologerId(): ?int
    {
        return $this->astrologerId;
    }

    public function setAstrologerId(int $astrologerId): self
    {
        $this->astrologerId = $astrologerId;

        return $this;
    }

    public function getServiceId(): ?int
    {
        return $this->serviceId;
    }

    public function setServiceId(int $serviceId): self
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAstrologer(): ?Astrologer
    {
        return $this->astrologer;
    }

    public function setAstrologer(?Astrologer $astrologer): self
    {
        $this->astrologer = $astrologer;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }
}
