<?php

declare(strict_types=1);

class MovementOption
{
    private string $direction;
    private TileInterface $tile;
    private string $currentDirection;

    public function __construct(string $currentDirection, string $direction, TileInterface $tile) {

        $this->direction = $direction;
        $this->tile = $tile;
        $this->currentDirection = $currentDirection;
    }

    public function getTile(): TileInterface
    {
        return $this->tile;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function convertToInstruction(): string
    {
        if ($this->direction === $this->currentDirection) {
            return 'V';
        }

        switch (true) {
            case $this->direction === DirectionOfTravel::WEST && $this->currentDirection === DirectionOfTravel::NORTH:
            case $this->direction === DirectionOfTravel::NORTH && $this->currentDirection === DirectionOfTravel::EAST:
            case $this->direction === DirectionOfTravel::EAST && $this->currentDirection === DirectionOfTravel::SOUTH:
            case $this->direction === DirectionOfTravel::SOUTH && $this->currentDirection === DirectionOfTravel::WEST:
                return 'LV';
            case $this->direction === DirectionOfTravel::EAST && $this->currentDirection === DirectionOfTravel::NORTH:
            case $this->direction === DirectionOfTravel::SOUTH && $this->currentDirection === DirectionOfTravel::EAST:
            case $this->direction === DirectionOfTravel::WEST && $this->currentDirection === DirectionOfTravel::SOUTH:
            case $this->direction === DirectionOfTravel::NORTH && $this->currentDirection === DirectionOfTravel::WEST:
                return 'RV';
            case $this->direction === DirectionOfTravel::SOUTH && $this->currentDirection === DirectionOfTravel::NORTH:
            case $this->direction === DirectionOfTravel::WEST && $this->currentDirection === DirectionOfTravel::EAST:
            case $this->direction === DirectionOfTravel::NORTH && $this->currentDirection === DirectionOfTravel::SOUTH:
            case $this->direction === DirectionOfTravel::EAST && $this->currentDirection === DirectionOfTravel::WEST:
                return 'BV';
        }

        throw new RuntimeException('Cannot convert direction??');
    }
}

