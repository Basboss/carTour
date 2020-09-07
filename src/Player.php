<?php
namespace Game;

use Game\Vehicle\Vehicle;

final class Player{
    private $username;
    private $team;
    private $vehicle;
    private $uid;

    private $level = 1;
    private $care;

    private static $counter = 0;

    public function __construct( $username, $team, $vehicle, $level )
    {
        $this->username = $username;
        $this->team = $team;
        $this->vehicle = $vehicle;

        if( is_int( $level ) && $level > 0 && $level <= 100 ){
            $this->level = $level;
        }

        $this->care = mt_rand( 0, 5 );
        $this->uid = $this->generateUid();

        self::$counter++;
    }

    public function drive()
    {
        if( $this->vehicle->isStart() ){
            $performance = $this->estimatePerformance();

            if( $performance < 10 ){
                $this->vehicle->decreaseSpeed();
            }else if( $performance > 50 ){
                $this->vehicle->increaseSpeed();
            }
        }else{
            $this->vehicle->start();
            $this->vehicle->bonus();
            $this->vehicle->increaseSpeed();
        }

        return $this->vehicle->getSpeed();
    }

    public function getIdentity()
    {
        return $this->username . ' - ' . $this->team;
    }

    private function estimatePerformance()
    {
        $limit = 100;
        $limit += $this->care * 2;
        $performance = mt_rand( 0, $limit );
        $performance += round( $this->level / 10 );

        return $performance;
    }

    public function __sleep()
    {
        return array('username', 'team', 'level', 'care');
    }

    public function __wakeup()
    {
        $this->uid = $this->generateUid();
    }

    public function getUid()
    {
        return $this->uid;
    }

    public function setVehicle(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    private function generateUid()
    {
        return uniqid('u_', false);
    }

    public static function getCounter()
    {
        return self::$counter;
    }

    public static function save(Player $player)
    {
        $serialized = serialize($player);
        $_SESSION['users'][$player->getUid()] = $serialized;
    }

    public static function reload()
    {
        $reloaded = $_SESSION['users'];
        $players = array();

        foreach($reloaded as $serialized) {
        $players[] = unserialize($serialized);
        }

        return $players;
    }
}