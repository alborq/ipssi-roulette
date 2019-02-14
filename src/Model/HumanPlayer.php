<?php

declare(strict_types=1);

namespace App\Model;

class HumanPlayer
{
    /** @var string */
    private $name;

    /** @var int */
    private $amount;

    public function __construct(string $name, int $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
