<?php

declare(strict_types=1);

class TileFactory
{
    public static function createFromChar(string $char, bool $firstOrLast): TileInterface
    {
        switch (strtoupper($char)) {
            case 'X':
                return new Fence();
            case 'J':
                return new Justin();
            case $char === ' ' && $firstOrLast:
                return new Gate();
            case ' ':
                return new Open();
            case 'A':
                return new Car();
            case 'B':
                return new Van();
            default:
                throw new RuntimeException(sprintf('Unknown type of tile: %s', $char));
        }
    }
}

