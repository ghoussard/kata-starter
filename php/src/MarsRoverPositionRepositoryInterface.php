<?php

namespace KataStarter;

interface MarsRoverPositionRepositoryInterface
{
    public function add(Position $position): void;

    public function get(int $index): Position;
}
