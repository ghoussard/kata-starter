<?php

namespace KataStarter;

class OrderMarsRoverService
{
    /** @var Position[] */
    private array $positions;

    /**
     * @param Instruction[] $instructions
     */
    public function order(Order ...$orders): void
    {
        foreach ($orders as $index => $order) {
            $this->positions[$index] = $order->initialPosition;

            foreach ($order->instructions as $instruction) {
                if ($instruction === Instruction::Move) {
                    $this->positions[$index] = $this->positions[$index]->move();
                }
                elseif ($instruction === Instruction::Left) {
                    $this->positions[$index]= $this->positions[$index]->left();
                }
                elseif ($instruction === Instruction::Right) {
                    $this->positions[$index]= $this->positions[$index]->right();
                }
            }
        }

    }

    public function currentPositions(): array
    {
        return $this->positions;
    }
}
