<?php

namespace KataStarter;

class MarsRoverPositionInMemoryRepository implements MarsRoverPositionRepositoryInterface
{
    /** @var Position[] */
    private array $positions;

    public function get(int $index): Position
    {
        return $this->positions[$index];
    }

    public function add(Position $position): void
    {
        $this->positions[] = $position;
    }
}
