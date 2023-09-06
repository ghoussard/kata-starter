<?php

namespace KataStarter;

class Cardinal
{
    private const NORTH = 'N';

    private function __construct(string $direction)
    {
    }

    public static function north(): self
    {
        return new self(self::NORTH);
    }
}
