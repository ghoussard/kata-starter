<?php

namespace KataStarter;

class OrderMarsRoverService
{
    private Position $position;

    public function order(Position $initialPosition, string $instructions): void
    {
        $this->position = $initialPosition;
    }

    public function currentPosition(): Position
    {
        return $this->position;
    }
}
