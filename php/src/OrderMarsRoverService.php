<?php

namespace KataStarter;

class OrderMarsRoverService
{
    public function __construct(
        private MarsRoverPositionRepositoryInterface $positionRepository,
    ) {
    }

    public function order(Order ...$orders): void
    {
        foreach ($orders as $order) {
            $position = $this->followInstructionsFromPosition($order->instructions, $order->initialPosition);
            $this->positionRepository->add($position);
        }
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
