<?php

declare(strict_types=1);

class Fence extends AbstractTile
{
    public function getChar(): string
    {
        return 'X';
    }

    public function isAccessible(string $status): bool
    {
        return false;
    }
}

