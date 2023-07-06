<?php
class Attacks
{

    public string $name;
    public int $damage;


    public function __construct(string $name, int $damage)
    {
        $this->name = $name;
        $this->damage = $damage;
   
    }
}
?>