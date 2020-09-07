<?php
namespace Game\Vehicle;

class Car extends Vehicle{

    public function bonus()
    {
        $this->speed += 5;
    }
    
}