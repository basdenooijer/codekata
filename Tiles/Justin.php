<?php

declare(strict_types=1);

class Justin extends AbstractTile
{
    private $facing = DirectionOfTravel::EAST;

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

    public function setFacingDirection(string $direction): void
    {
        $this->facing = $direction;
    }
}

