<?php

namespace Game\Entity;

class Track extends Entity{
    private $name;
    private $type;
    private $distance;

    public function getName(): string
    {
        return $this->name;
    }   

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }   

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getDistance(): int
    {
        return $this->distance;
    }   

    public function setDistance(int $distance)
    {
        $this->distance = $distance;
        return $this;
    }
}
