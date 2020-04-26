<?php

namespace App\TransportObject\Command;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class BuyService
 * @package App\TransportObject\Command
 */
class BuyService
{
    /**
     * @var int
     * @Assert\Positive(message="Service ID must be positive number, {{ value }} given")
     */
    private int $id;

    /**
     * @var string
     * @Assert\Email()
     */
    private string $email;

    /**
     * @var string
     * @Assert\Length(min="2", minMessage="{{ value }} is too short. Name must be at least {{ limit }} characters long")
     */
    private string $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}