<?php
require_once 'src/Autoloader.php';

use Game\Autoloader;
use Game\Race;
use Game\Player;
use Game\Vehicle\Car;
use Game\Vehicle\Truck;
use Game\Vehicle\Vehicle;
use Game\Vehicle\Motorcycle;

Autoloader::register();

$ford = new Car( 'Ford Mustang', Vehicle::POWER['SUPER'] );
$jeanPaul = new Player( 'Jean-Paul', 'Dream Team Tunning', $ford, 24 );

$tesla = new Car( 'Tesla Model X', Vehicle::POWER['HIGH'] );
$jeanJacques = new Player( 'Jean-Jacques', 'RC Tunning 59', $tesla, 75 );

$gsxr = new Motorcycle( 'GSXR', Vehicle::POWER['FURIUS'] );
$jeanPierre = new Player( 'Jean-Pierre', 'RC Tunning 59', $gsxr, 35 );

$scania = new Truck( 'Scania R', Vehicle::POWER['LOW'] );
$jeanMarc = new Player( 'Jean-Marc', 'Truck Racing', $scania, 90 );

$monza = new Race( 'Monza', Race::TYPE_SNOW, 1200, Race::WEATHER['SUNNY'] );
$monza->addPlayer( $jeanPaul );
$monza->addPlayer( $jeanJacques );
$monza->addPlayer( $jeanPierre );
$monza->addPlayer( $jeanMarc );

$monza->start();

$randomRace = Race::generate();
$randomRace->addPlayer( $jeanJacques );
$randomRace->addPlayer( $jeanPierre );
$randomRace->start();
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarTour</title>
</head>
<body>
    <h1>CarTour</h1>

    <p>
        Il y a <?php echo Player::getCounter(); ?> personnes <br>
        Dont <?php echo ( Player::getCounter() - $monza->countPlayers() ); ?> spectateurs
    </p>

    <h2>Résultats : <?php echo $monza->getTrack(); ?></h2>
    <ul>
        <?php foreach( $monza->getRanking() as $rank ){ ?>
            <li><?php echo $rank->getIdentity(); ?></li>
        <?php } ?>
    </ul>

    <h2>Résultats : <?php echo $randomRace->getTrack(); ?></h2>
    <ul>
        <?php foreach( $randomRace->getRanking() as $rank ){ ?>
            <li><?php echo $rank->getIdentity(); ?></li>
        <?php } ?>
    </ul>
</body>
</html>