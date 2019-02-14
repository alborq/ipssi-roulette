<?php

declare(strict_types=1);

namespace App\Model;

class BotPlayer implements PlayerInterface
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $money;

    public function __construct()
    {
        $botNames = ['Jean Bot', 'Botiste', 'BroBot', 'Dark Vador', 'Obiwan'];
        $this->name = $botNames[random_int(0, count($botNames)-1)];
        $this->money = random_int(0 , 3000);
    }

    public function getAmount() :int
    {
        return $this->money;
    }

    public function getName() : string
    {
        return $this->name;
    }
}
