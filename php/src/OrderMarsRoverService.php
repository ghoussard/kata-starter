<?php

namespace KataStarter;

class OrderMarsRoverService
{
    private Position $position;

    public function order(Position $initialPosition, string $instructions): void
    {
        $this->position = $initialPosition;

        foreach (str_split($instructions) as $instruction) {
            switch ($instruction) {
                case 'M':
                    $this->position = $this->position->move();
                    break;
            }
        }
    }

    public function currentPosition(): Position
    {
        return $this->position;
    }
}
