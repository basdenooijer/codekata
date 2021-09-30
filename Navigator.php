<?php

declare(strict_types=1);

class Navigator
{
    private Map $map;
    private bool $debug;

    public function __construct(Map $map, $debug = false)
    {
        $this->map = $map;
        $this->debug = $debug;
    }

    public function navigate(): void
    {
        $justin = $this->map->getJustin();
        $path = new Path($justin->getFacingDirection(), $justin->getX(), $justin->getY());

        $this->explorePath($path);
    }

    public function explorePath(Path $path): void
    {
        foreach ($this->getMovementOptions($path) as $option) {
            $newPath = $path->addMove($option);

            if ($this->debug) {
                echo $this->map->draw($newPath);
                usleep(100000);
            }

            $this->explorePath($newPath);
        }

        if ($path->getStatus() === Path::STATUS_FINISHED) {
            echo $this->map->draw($path);
            echo PHP_EOL.PHP_EOL;
            echo $path->getInstructions();
            echo PHP_EOL.PHP_EOL;
            exit();
        }

        //TODO return value
    }

    private function getMovementOptions(Path $path): iterable
    {
        $tiles = $this->map->getSurroundingTiles($path->getX(), $path->getY());

        $options = [];
        foreach ($tiles as $direction => $tile) {
            if (!$tile instanceof TileInterface) continue;

            if (!$tile->isAccessible($path->getStatus())) continue;

            $option = new MovementOption($path->getDirection(), $direction, $tile);

            // prevents back moves for instance
            if (!$path->canMove($option)) continue;

            yield $option;
        }

        return $options;
    }

    private function move($option): void
    {

    }
}

