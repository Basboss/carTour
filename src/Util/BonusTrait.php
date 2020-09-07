<?php

namespace Game\Util;

trait BonusTrait {
    private $thdBonus = 10;
    private $bonus = 0;

    abstract public function bonus();

    public function increaseBonus()
    {
        $this->bonus = mt_rand(1, 3);
    }

    public function enableBonus()
    {
        $this->increaseBonus();
        if($this->bonus >= $this->thdBonus) {
            $this->bonus();
            $this->bonus = 0;
        }
    }
}