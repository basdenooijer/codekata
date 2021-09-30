<?php

declare(strict_types=1);

class BruteForceNavigationStrategy implements NavigationStrategyInterface
{
    public function getMovementOptions(Map $map, Path $path): iterable
    {
        $tiles = $map->getSurroundingTiles($path->getX(), $path->getY());

        foreach ($tiles as $direction => $tile) {
            if (!$tile instanceof TileInterface) {
                continue;
            }

            if (!$tile->isAccessible($path->getStatus())) {
                continue;
            }

            $option = new MovementOption($path->getDirection(), $direction, $tile);

            // prevents back moves for instance, or infinite loops
            if (!$path->canMove($option)) {
                continue;
            }

            yield $option;
        }
    }
}

