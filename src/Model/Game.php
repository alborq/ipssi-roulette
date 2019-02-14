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
        /** @var PlayerInterface[] $players */
        $players = [];

        do {
            $name = $this->consoleInteraction->askText('Quel est votre nom ?');
            $amount = $this->consoleInteraction->askInt('Combien avez-vous en poche ? (en €)');

            $players[] = new HumanPlayer($name, $amount);

            $result = false;
            if(count($players) < 6) {
                $result = $this->consoleInteraction->askYesNo('Ajouter un nouveau joueur ? (Oui/Non)');
            }
        } while ($result);

        $nbBot = random_int(0, 6) - count($players);
        for($i = 0; $i < $nbBot; $i++) {
            $players[] = new BotPlayer();
        }

        $joueurNames = [];
        foreach ($players as $player) {
            $joueurNames[] = $player->getName();
        }

        $this->consoleInteraction->gameSay(count($players) . ' joueur(s) ont rejoins la table');
        $this->consoleInteraction->gameSay('Bienvenue à ' . implode(', ', $joueurNames));

        $cases = $this->getCases();
        $finalResult = $cases[array_rand($cases, 1)];
        $this->consoleInteraction->displayWheels($finalResult, $cases);
    }

    private function getCases(): array
    {
        $casesNumber = [32,15,19,4,21,2,25,17,34,6,27,13,36,11,30,8,
            23,10,5,24,16,33,1,20,14,31,9,22,18,29,7,28,12,35,3,26];

        $cases = [new CaseRoulette(0, 'Vert')];
        $isOdd = true;
        foreach ($casesNumber as $num) {
            $cases[] = new CaseRoulette($num, $isOdd ? 'Rouge' : 'Noir');
            $isOdd = !$isOdd;
        }

        return $cases;
    }
}
