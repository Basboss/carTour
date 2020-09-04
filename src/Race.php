<?php

namespace Game;

class Race{
    const MIN_DISTANCE = 100;
    const WEATHER = array(
        'SUNNY' => 1,
        'FOGGY' => 2,
        'RAINY' => 3,
    );
    const TYPE_ROAD = 'road';
    const TYPE_DIRT = 'dirt';
    const TYPE_SNOW = 'snow';

    private $track;
    private $type;
    private $distance;
    private $lap = 5;
    private $weather;

    private $players = array();
    private $ranking = array();

    public function __construct( $track, $type, $distance, $weather, $lap = null )
    {
        $this->track = $track;
        $this->type = $type;
        $this->weather = $weather;
        
        if( is_int( $distance ) && $distance > self::MIN_DISTANCE ){
            $this->distance = $distance;
        }else{
            $this->distance = self::MIN_DISTANCE;
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
        ksort( $this->ranking );
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

    public function countPlayers()
    {
        return count( $this->players );
    }

    public function getTrack()
    {
        return $this->track;
    }

    public static function generate()
    {
        $tracks = array(
            array(
                'name' => 'Monza',
                'type' => self::TYPE_ROAD,
                'distance' => 1200,
            ),
            array(
                'name' => 'SPA',
                'type' => self::TYPE_ROAD,
                'distance' => 2400,
            ),
            array(
                'name' => 'Tigne Challenge',
                'type' => self::TYPE_SNOW,
                'distance' => 1200,
            ),
            array(
                'name' => 'Citadelle Trophy',
                'type' => self::TYPE_DIRT,
                'distance' => 1200,
            ),
        );

        $trackKey = array_rand( $tracks );
        $track = $tracks[ $trackKey ];

        $weather = array_rand( self::WEATHER );
        return new Race( 
            $track['name'], 
            $track['type'], 
            $track['distance'], 
            self::WEATHER[ $weather ],
            rand( 5, 15 )
        );
    }
}