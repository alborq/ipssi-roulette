<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use App\Console\ConsoleInteraction;
use App\Model\Game;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

(new Application())
    ->register('echo')
    ->setCode(function(InputInterface $input, OutputInterface $output) {
        $game = new Game(
            new ConsoleInteraction($input, $output)
        );

        $game->start();
    })
    ->getApplication()->setDefaultCommand('echo', true)->run();
