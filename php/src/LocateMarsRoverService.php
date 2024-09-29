<?php

namespace KataStarter;

class LocateMarsRoverService
{
    public function __construct(
        private readonly MarsRoverPositionRepositoryInterface $repository
    ) {}

    public function locateRovers(): array
    {
        return [
            $this->repository->get(0),
        ];
    }
}
