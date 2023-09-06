<?php

namespace KataStarter;

class Instruction
{
    private const MOVE = 'M';
    /**
     * @param string $action
     */
    private function __construct(private string $action)
    {
    }

    public static function move(): self
    {
        return new self(self::MOVE);
    }

    public function isMove(): bool
    {
        return $this->action === self::MOVE;
    }
}
