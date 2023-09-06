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
}
