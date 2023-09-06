<?php

namespace KataStarter;

class OrderMarsRoverService
{
    private Position $position;

    /**
     * @param Instruction[] $instructions
     */
    public function order(Position $initialPosition, array $instructions): void
    {
        $this->position = $initialPosition;

        foreach ($instructions as $instruction) {
            if ($instruction === Instruction::Move) {
                $this->position = $this->position->move();
            }
            elseif ($instruction === Instruction::Left) {
                $this->position = $this->position->left();
            }
            elseif ($instruction === Instruction::Right) {
                $this->position = $this->position->right();
            }
        }
    }

    public function currentPosition(): Position
    {
        return $this->position;
    }
}
