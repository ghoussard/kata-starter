<?php

namespace KataStarter;

class OrderMarsRoverService
{
    /** @var Position[] */
    private array $positions;

    /**
     * @param Instruction[] $instructions
     */
    public function order(Order $order): void
    {
        $this->positions[0] = $order->initialPosition;

        foreach ($order->instructions as $instruction) {
            if ($instruction === Instruction::Move) {
                $this->positions[0] = $this->positions[0]->move();
            }
            elseif ($instruction === Instruction::Left) {
                $this->positions[0]= $this->positions[0]->left();
            }
            elseif ($instruction === Instruction::Right) {
                $this->positions[0]= $this->positions[0]->right();
            }
        }
    }

    public function currentPosition(): Position
    {
        return $this->positions[0];
    }
}
