<?php

declare(strict_types=1);

class Path
{
    public const STATUS_DRIVING = 'driving';
    public const STATUS_WALKING = 'walking';
    public const STATUS_FINISHED = 'finished';

    private int $xPos;
    private int $yPos;
    private string $direction;
    private array $coords = [];
    private array $instructions = [];

    private string $status = self::STATUS_WALKING;

    public function __construct(string $direction, int $x, int $y) {
        $this->direction = $direction;
        $this->xPos = $x;
        $this->yPos = $y;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function canMove(MovementOption $move): bool
    {
        return !in_array($this->toCoords($move), $this->coords, true);
    }

    public function addMove(MovementOption $move): self
    {
        $newPath = clone $this;
        $newPath->instructions[] = $move->convertToInstruction();
        $newPath->direction = $move->getDirection();
        $newPath->coords[] = $this->toCoords($move);
        $newPath->xPos = $move->getTile()->getX();
        $newPath->yPos = $move->getTile()->getY();

        if ($move->getTile() instanceof Van) {
            $newPath->coords = []; //Reset prev. path to prevent blocking
            $newPath->status = self::STATUS_DRIVING;
        }

        if ($move->getTile() instanceof Gate) {
            $newPath->status = self::STATUS_FINISHED;
        }

        return $newPath;
    }

    private function toCoords(MovementOption $move): string
    {
        return sprintf('%s-%s', $move->getTile()->getY(), $move->getTile()->getX());
    }

    public function getInstructions(): string
    {
        return implode('', $this->instructions);
    }

    public function getX(): int
    {
        return $this->xPos;
    }

    public function getY(): int
    {
        return $this->yPos;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}

