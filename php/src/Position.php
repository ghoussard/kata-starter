<?php

namespace KataStarter;

class Position
{
    public function __construct(private int $x, private int $y, private Cardinal $direction)
    {
    }

    public function move(): Position
    {
        return new self(
            $this->x,
            $this->y + 1,
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
