<?php

declare(strict_types=1);

class Van extends AbstractTile
{
    public function getChar(): string
    {
        return 'V';
    }

    public function isAccessible(string $status): bool
    {
        return $status === Path::STATUS_WALKING;
    }
}

