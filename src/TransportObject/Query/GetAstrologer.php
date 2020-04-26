<?php

namespace App\TransportObject\Query;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class GetAstrologer
 * @package App\TransportObject\Query
 */
class GetAstrologer
{
    /**
     * @var int
     * @Assert\Positive(message="Astrologer ID must be positive number, {{ value }} given")
     */
    private int $id;

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
}