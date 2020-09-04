<?php
class Truck extends Vehicle {
    public function bonus()
    {
        $this->speed += 50;
    }
}