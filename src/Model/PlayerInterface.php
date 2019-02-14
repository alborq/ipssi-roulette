<?php

declare(strict_types=1);

namespace App\Model;

interface PlayerInterface
{
    public function getAmount(): int ;

    public function getName(): string;
}
