<?php

declare(strict_types=1);

namespace App\Model;

use App\Console\ConsoleInteraction;

class Game
{
    /** @var ConsoleInteraction */
    private $consoleInteraction;

    public function __construct(ConsoleInteraction $consoleInteraction)
    {
        $this->consoleInteraction = $consoleInteraction;
    }

    public function start(): void
    {
        $this->consoleInteraction->gameSay('Hello');
    }
}
