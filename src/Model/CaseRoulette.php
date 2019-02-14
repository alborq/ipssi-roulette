<?php

declare(strict_types=1);


namespace App\Model;


class CaseRoulette
{
    /**@var int*/
    private $number;

    /**@var string*/
    private $color;

    public function __construct(int $number,string $color)
    {
        $this->number = $number;
        $this->color= $color;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}
