<?php

require("attacks.php");

class Champion
{
    public int $id;
    public string $name;
    public int $hp;
    public int $power;
    public string $type;
    public $attacks = array();


    public function __construct(int $id, string $name, int $hp, int $power, string $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->hp = $hp;
        $this->power = $power;
        $this->type = $type;

    }
    public function addAttack(string $name, int $damage)
    {
        $attack = new Attacks($name, $damage);
        array_push($this->attacks, $attack);
    }

    public function getAttacks(): array
    {
        return $this->attacks;
    }
}

