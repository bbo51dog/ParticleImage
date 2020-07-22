<?php

namespace bbo51dog\particleimage\form\base;

use pocketmine\Player;
use pocketmine\form\Form as PMForm;

abstract class Form implements PMForm{

    /** @var array */
    protected $data =[];

    public function send(Player $player): void{
        $player->sendForm($this);
    }

    public function jsonSerialize(){
        return $this->data;
    }
}
