<?php

declare(strict_types=1);

interface NavigationStrategyInterface
{
    /** @return MovementOption[] */
    public function getMovementOptions(Map $map, Path $path): iterable;
}

