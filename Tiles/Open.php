<?php

declare(strict_types=1);

class Open extends AbstractTile
{
    public function getChar(): string
    {
        return ' ';
    }

    public function isAccessible(string $status): bool
    {
        return true;
    }
}

