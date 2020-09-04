<?php
abstract class Vehicle{
    const MAX_SPEED = 350;
    const MAX_STATE = 100;
    const POWER = array(
        'LOW' => 1,
        'MEDIUM' => 2,
        'HIGH' => 3,
        'SUPER' => 4,
        'FURIUS' => 5,
    );
    
    private $model;
    protected $power;

    private $engine = false;
    private $state = self::MAX_STATE;
    protected $speed = 0;

    public function __construct( $model, $power )
    {
        $this->model = $model;
        if( in_array( $power, self::POWER ) ){
            $this->power = $power;
        }else{
            $this->power = self::POWER['LOW'];
        }
    }

    public function start()
    {
        $this->engine = true;
    }

    public function isStart()
    {
        return $this->engine;
    }

    public function increaseSpeed()
    {
        $this->speed += $this->power * 10;
        if( $this->speed >= self::MAX_SPEED ){
            $this->speed = self::MAX_SPEED;
        }

        return $this->speed;
    }

    public function decreaseSpeed()
    {
        $this->speed -= $this->power * 5;
        if( $this->speed < 0 ){
            $this->speed = 0;
        }

        return $this->speed;
    }

    final public function setDamage( $damage )
    {
        $this->state -= $damage;

        if( $this->state <= 0 ){
            $this->state = 0;
            return false;
        }

        return true;
    }

    public function repair()
    {
        $this->state = self::MAX_STATE;
    }

    public function stop()
    {
        $this->engine = false;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    abstract public function bonus();
}



