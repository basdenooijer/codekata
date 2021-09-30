<?php

declare(strict_types=1);

class Navigator
{
    private Map $map;
    private bool $debug;
    private NavigationStrategyInterface $strategy;

    public function __construct(Map $map, NavigationStrategyInterface $strategy, $debug = false)
    {
        $this->map = $map;
        $this->debug = $debug;
        $this->strategy = $strategy;

        if ($debug) {
            system('clear');
        }
    }

    public function navigate(): void
    {
        $justin = $this->map->getJustin();
        $path = new Path($justin->getFacingDirection(), $justin->getX(), $justin->getY());

        $this->explorePath($path);
    }

    public function explorePath(Path $path): void
    {
        foreach ($this->strategy->getMovementOptions($this->map, $path) as $option) {
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

    private function move($option): void
    {

    }
}

