<?php

declare(strict_types=1);

abstract class AbstractTile implements TileInterface
{
    private int $x;
    private int $y;

    // TODO refactor knowledge of position out of Tile
    public function setPosition($x, $y): void
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }
}

