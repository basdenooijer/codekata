<?php

//TODO autoload
include 'DirectionOfTravel.php';
include 'Map.php';
include 'Navigation/NavigationStrategyInterface.php';
include 'Navigation/BruteForceNavigationStrategy.php';
include 'Navigation/LookAheadNavigationStrategy.php';
include 'Navigation/Navigator.php';
include 'Tiles/TileInterface.php';
include 'Tiles/AbstractTile.php';
include 'Tiles/Car.php';
include 'Tiles/Fence.php';
include 'Tiles/Justin.php';
include 'Tiles/Open.php';
include 'Tiles/TileFactory.php';
include 'Tiles/Van.php';
include 'MovementOption.php';
include 'Path.php';
include 'Tiles/Gate.php';

$map = Map::createFromFile('map.txt');

//$navigator = new Navigator($map, new BruteForceNavigationStrategy(), true);
$navigator = new Navigator($map, new LookAheadNavigationStrategy(), true);
$navigator->navigate();

