<?php

namespace KataStarter;

class Position
{
    public function __construct(private int $x, private int $y, private Cardinal $direction)
    {
    }
}
