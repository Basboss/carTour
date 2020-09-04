<?php
class Car extends Vehicle {
    public function bonus()
    {
        $this->speed += 5;
    }
}