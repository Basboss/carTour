<?php
require_once 'Race.php';
require_once 'Player.php';
require_once 'Vehicle.php';

$ford = new Vehicle( 'Ford Mustang', 5 );
$jeanPaul = new Player( 'Jean-Paul', 'Dream Team Tunning', $ford, 24 );

$tesla = new Vehicle( 'Tesla Model X', 3 );
$jeanJacques = new Player( 'Jean-Jacques', 'RC Tunning 59', $tesla, 75 );

$monza = new Race( 'Monza', 'road', 1200, 'sun' );
$monza->addPlayer( $jeanPaul );
$monza->addPlayer( $jeanJacques );

$monza->start();
var_dump( $monza->getRanking() );