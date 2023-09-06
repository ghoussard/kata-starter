<?php

namespace KataStarter;

class OrderMarsRoverService
{
    /** @var Position[] */
    private array $positions;

    public function order(Order ...$orders): void
    {
        foreach ($orders as $index => $order) {
            $position = $this->followInstructionsFromPosition($order->instructions, $order->initialPosition);
            $this->positions[$index] = $position;
        }
    }

    public function currentPositions(): array
    {
        return $this->positions;
    }

    /**
     * @param Instruction[] $instructions
     */
    private function followInstructionsFromPosition(array $instructions, Position $position): Position
    {
        foreach ($instructions as $instruction) {
            match ($instruction) {
                Instruction::Move => $position = $position->move(),
                Instruction::Left => $position = $position->left(),
                Instruction::Right => $position = $position->right(),
            };
        }

        return $position;
    }
}
