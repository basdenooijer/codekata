<?php

declare(strict_types=1);

/**
 * This strategy sorts movementOptions based on distance to target for the next step,
 * if the next steps are equal a lookAhead is used until there is a difference
 *
 * TODO: this causes some double step calculation, optimize
 * TODO: refactor the POC implementation of this class
 */
class LookAheadNavigationStrategy extends BruteForceNavigationStrategy
{
    public function getMovementOptions(Map $map, Path $path): iterable
    {
        $options = [];
        array_push($options, ...parent::getMovementOptions($map, $path));

        //Todo determine target based on map and status
        if ($path->getStatus() === Path::STATUS_WALKING) {
            $targetY = 8;
            $targetX = 5;
        } else {
            $targetY = 19;
            $targetX = 18;
        }

        usort($options, function (MovementOption $optionA, MovementOption $optionB) use ($map, $path, $targetY, $targetX) {
            $distanceA = $this->getDistanceFromTarget($optionA, $targetX, $targetY);
            $distanceB = $this->getDistanceFromTarget($optionB, $targetX, $targetY);

            if ($distanceA === $distanceB) {
                [$optionA, $optionB] = $this->lookAhead($map, $path, $optionA, $optionB, $targetY, $targetX);
                $distanceA = $this->getDistanceFromTarget($optionA, $targetX, $targetY);
                $distanceB = $this->getDistanceFromTarget($optionB, $targetX, $targetY);
            }

            return ($distanceA < $distanceB) ? -1 : 1;
        });

        return $options;
    }

    private function getDistanceFromTarget(MovementOption $option, int $targetY, int $targetX): int {
        return abs($targetX - $option->getTile()->getX()) + abs($targetY - $option->getTile()->getY());
    }

    private function lookAhead(Map $map, Path $path, MovementOption $optionA, MovementOption $optionB, int $targetY, int $targetX): array
    {
        $nextOptionsA = $this->getMovementOptions($map, $path->addMove($optionA));
        $nextOptionsB = $this->getMovementOptions($map, $path->addMove($optionB));

        return [
            $this->determineBestOptionDistance($nextOptionsA, $targetY, $targetX),
            $this->determineBestOptionDistance($nextOptionsB, $targetY, $targetX)
        ];
    }

    private function determineBestOptionDistance(iterable $options, int $targetY, int $targetX): MovementOption
    {
        $bestDistance = 999999;
        $bestOption = null;
        foreach ($options as $option) {
            $distance = $this->getDistanceFromTarget($option, $targetX, $targetY);
            if ($distance < $bestDistance) {
                $bestDistance = $distance;
                $bestOption = $option;
            }
        }

        return $bestOption;
    }
}

