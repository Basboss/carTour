<?php
class Race{
    // Nombre de joueur minimum

    private $track;
    private $type;
    private $distance;
    private $lap = 5;
    private $weather;

    private static $players = array();
        const MAX_PLAYERS = 2;
    
    private $ranking = array();

    public function __construct( $track, $type, $distance, $weather, $lap = null )
    {
        $this->track = $track;
        $this->type = $type;
        $this->weather = $weather;
        
        if( is_int( $distance ) && $distance > 100 ){
            $this->distance = $distance;
        }else{
            $this->distance = 100;
        }

        if( is_int( $lap ) && $lap > 0 ){
            $this->lap = $lap;
        }
    }

    public function addPlayer( $player )
    {
        $this->players[] = $player;
    }

    public function start()
    {
        for( $i = 0; $i < $this->lap; $i++ ){
            $this->simulateLap();
        }
    }

    public function getRanking()
    {
        return $this->ranking;
    }

    private function simulateLap()
    {
        foreach( $this->players as $player ){
            $speed = $player->drive();
            $thd = ceil( $speed / 10 ) + 1;
            $key = round( $this->distance / $thd );

            $rankKey = array_search( $player, $this->ranking );
            if( $rankKey ){
                unset( $this->ranking[ $rankKey ] );
                $total = $rankKey + $key;
                $this->ranking[ $total ] = $player;
            }else{
                $this->ranking[ $key ] = $player;
            }
        }
    }

    public static function getPlayers() {
        return self::$players;
    }
    
}
echo Player::$count();
// $player = new Player( $username, $team, $vehicle, $level);
// echo Player::$count();