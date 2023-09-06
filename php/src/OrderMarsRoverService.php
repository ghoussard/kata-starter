<?php

namespace KataStarter;

class OrderMarsRoverService
{
    private string $position;

    public function order(string $initialPosition, string $instructions): void
    {
        $this->position = $initialPosition;
    }

    public function currentPosition(): string
    {
        return $this->position;
    }
}
