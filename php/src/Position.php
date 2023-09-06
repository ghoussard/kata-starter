<?php

namespace KataStarter;

class Position
{
    public function __construct(private int $x, private int $y, private Cardinal $direction)
    {
    }

    public function move(): Position
    {
        $x = match ($this->direction) {
            Cardinal::East => $this->x + 1,
            Cardinal::West => $this->x - 1,
            default => $this->x,
        };

        $y = match ($this->direction) {
            Cardinal::North => $this->y + 1,
            Cardinal::South => $this->y - 1,
            default => $this->y,
        };

        return new self(
            $x,
            $y,
            $this->direction
        );
    }

    public function left(): Position
    {
        $direction = match ($this->direction) {
            Cardinal::North => Cardinal::West,
            Cardinal::West => Cardinal::South,
            Cardinal::South => Cardinal::East,
            Cardinal::East => Cardinal::North,
        };

        return new self(
            $this->x,
            $this->y,
            $direction
        );
    }

    public function right(): Position
    {
        $direction = match ($this->direction) {
            Cardinal::North => Cardinal::East,
            Cardinal::East => Cardinal::South,
            Cardinal::South => Cardinal::West,
            Cardinal::West => Cardinal::North,
        };

        return new self(
            $this->x,
            $this->y,
            $direction
        );
    }
}
