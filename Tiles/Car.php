<?php

declare(strict_types=1);

class Car extends AbstractTile
{
    public function getChar(): string
    {
        return 'A';
    }

    public function isAccessible(string $status): bool
    {
        return false;
    }
}

