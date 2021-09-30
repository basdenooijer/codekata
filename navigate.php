<?php

//TODO autoload
include 'DirectionOfTravel.php';
include 'Map.php';
include 'Navigator.php';
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

echo $map->draw();

$navigator = new Navigator($map);
$navigator->navigate();

