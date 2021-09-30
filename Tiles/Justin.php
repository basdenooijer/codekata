<?php

declare(strict_types=1);

class Justin extends AbstractTile
{
    private string $facing = DirectionOfTravel::EAST;

    public function getChar(): string
    {
        return 'J';
    }

    public function isAccessible(string $status): bool
    {
        return false;
    }

    public function getFacingDirection(): string
    {
        return $this->facing;
    }
}

