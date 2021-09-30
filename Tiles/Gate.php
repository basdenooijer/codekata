<?php

declare(strict_types=1);

class Gate extends AbstractTile
{
    public function getChar(): string
    {
        return 'G';
    }

    public function isAccessible(string $status): bool
    {
        return $status === Path::STATUS_DRIVING;
    }
}

