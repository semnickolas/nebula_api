<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AstrologerService", mappedBy="service", orphanRemoval=true, cascade={"persist"})
     */
    private Collection $astrologerServices;

    public function __construct()
    {
        $this->astrologerServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|AstrologerService[]
     */
    public function getAstrologerServices(): Collection
    {
        return $this->astrologerServices;
    }

    public function addAstrologerService(AstrologerService $astrologerService): self
    {
        if (!$this->astrologerServices->contains($astrologerService)) {
            $this->astrologerServices[] = $astrologerService;
            $astrologerService->setService($this);
        }

        return $this;
    }

    public function removeAstrologerService(AstrologerService $astrologerService): self
    {
        if ($this->astrologerServices->contains($astrologerService)) {
            $this->astrologerServices->removeElement($astrologerService);
            // set the owning side to null (unless already changed)
            if ($astrologerService->getService() === $this) {
                $astrologerService->setService(null);
            }
        }

        return $this;
    }
}
