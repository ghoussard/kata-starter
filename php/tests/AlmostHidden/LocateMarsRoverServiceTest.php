<?php

namespace AlmostHidden;

use KataStarter\Cardinal;
use KataStarter\LocateMarsRoverService;
use KataStarter\MarsRoverPositionInMemoryRepository;
use KataStarter\MarsRoverPositionRepositoryInterface;
use KataStarter\Position;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class LocateMarsRoverServiceTest extends TestCase
{
    private MarsRoverPositionRepositoryInterface $repository;

    protected function setUp(): void
    {
        $this->repository = new MarsRoverPositionInMemoryRepository();
    }

    public function test_it_locates_the_rover()
    {
        $sut = new LocateMarsRoverService($this->repository);
        $this->repository->add(new Position(3, 1, Cardinal::West));
        Assert::assertEquals([
            new Position(3, 1, Cardinal::West),
        ], $sut->locateRovers());
    }
}
