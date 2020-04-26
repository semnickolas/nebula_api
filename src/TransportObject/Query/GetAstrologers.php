<?php


namespace App\TransportObject\Query;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class GetAstrologers
 * @package App\TransportObject\Query
 */
class GetAstrologers
{
    /**
     * @var int
     * @Assert\PositiveOrZero(message="Page must be positive number or zero, {{ value }} given")
     */
    private int $page;

    /**
     * @var int
     * @Assert\Positive(message="PageSize must be positive number, {{ value }} given")
     */
    private int $pageSize;

    /**
     * @var string|null
     */
    private ?string $filter = null;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     */
    public function setPageSize(int $pageSize): void
    {
        $this->pageSize = $pageSize;
    }

    /**
     * @return string|null
     */
    public function getFilter(): ?string
    {
        return $this->filter;
    }

    /**
     * @param string|null $filter
     */
    public function setFilter(?string $filter): void
    {
        $this->filter = $filter;
    }

    /**
     * @return int
     */
    public function getLimit() : int
    {
        return $this->pageSize;
    }

    /**
     * @return int
     */
    public function getOffset() : int
    {
        return $this->pageSize * ($this->page === 0 ? $this->page : $this->page - 1);
    }
}