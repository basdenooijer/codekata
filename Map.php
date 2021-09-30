<?php

declare(strict_types=1);

class Map
{
    private array $rows;
    private Justin $justin;

    public function __construct(array $rows) {
        $yPos = 0;
        foreach ($rows as $row) {
            $yPos++;
            $xPos = 0;
            foreach ($row as $tile) {
                $xPos++;

                if (!isset($this->rows[$yPos])) {
                    $this->rows[$yPos] = [];
                }

                $this->rows[$yPos][$xPos] = $tile;
                $tile->setPosition($xPos, $yPos);

                if ($tile instanceof Justin) {
                    $this->justin = $tile;
                }
            }
        }

        if (!$this->justin) {
            throw new RuntimeException('Justin not found on map?');
        }
    }

    public static function createFromFile(string $filePath): self
    {
        $rows = [];

        $text = file_get_contents($filePath);
        $lines = explode("\n", $text);

        $i = 0;
        $rowCount = count($lines);
        foreach ($lines as $line) {
            $i++;
            $rows[] = self::createRow(
                str_split($line),
                $i === 1 || $i === $rowCount
            );
        }

        return new self($rows);
    }

    public function draw(): string
    {
        $output = '';
        foreach ($this->rows as $row) {
            foreach ($row as $tile) {
                $output .= $tile->getChar();

                //$output .= str_pad($tile->getY() . '-' . $tile->getX(), 5);
            }
            $output .= PHP_EOL;
        }

        return $output;
    }

    private static function createRow(array $chars, bool $firstOrLast): array
    {
        $row = [];

        $i = 0;
        $charCount = count($chars);
        foreach ($chars as $char) {
            $i++;
            $row[] = TileFactory::createFromChar(
                $char,
                $firstOrLast || $i === 1 || $i === $charCount
            );
        }

        return $row;
    }

    public function getSurroundingTiles(int $xPos, int $yPos): array
    {
        return [
            DirectionOfTravel::NORTH => $this->getTile(
                $xPos,
                $yPos - 1
            ),
            DirectionOfTravel::EAST => $this->getTile(
                $xPos + 1,
                $yPos
            ),
            DirectionOfTravel::SOUTH => $this->getTile(
                $xPos,
                $yPos + 1
            ),
            DirectionOfTravel::WEST => $this->getTile(
                $xPos - 1,
                $yPos
            ),
        ];
    }

    private function getTile($xPos, int $yPos): ?TileInterface
    {
        if (!array_key_exists($yPos, $this->rows)) {
            return null;
        }

        $row = $this->rows[$yPos];

        return $row[$xPos] ?? null;
    }

    public function getJustin(): Justin
    {
        return $this->justin;
    }
}

