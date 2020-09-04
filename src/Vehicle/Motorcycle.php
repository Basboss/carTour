<?php
class Motorcycle extends Vehicle {
    public function bonus()
    {
        $this->speed += 1;
    }
}