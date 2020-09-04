<?php

namespace Game\Vehicle;

class Motorcycle extends Vehicle {
    public function bonus()
    {
        $this->speed += 1;
    }
}