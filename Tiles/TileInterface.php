<?php

declare(strict_types=1);

interface TileInterface
{
    // TODO refactor knowledge of position out of Tile
    public function setPosition($x, $y): void;

    public function getChar(): string;

    public function isAccessible(string $status): bool;

    public function getX(): int;

    public function getY(): int;
}

