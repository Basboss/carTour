<?php

namespace Game\Vehicle;

class Truck extends Vehicle {
    public function bonus()
    {
        $this->speed += 50;
    }
}