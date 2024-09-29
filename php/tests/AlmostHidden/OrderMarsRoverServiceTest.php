<?php

namespace KataStarter\Test\AlmostHidden;

use KataStarter\Cardinal;
use KataStarter\Instruction;
use KataStarter\MarsRoverPositionInMemoryRepository;
use KataStarter\MarsRoverPositionRepositoryInterface;
use KataStarter\Order;
use KataStarter\OrderMarsRoverService;
use KataStarter\Position;
use PHPUnit\Framework\TestCase;

class OrderMarsRoverServiceTest extends TestCase
{
    private MarsRoverPositionRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = new MarsRoverPositionInMemoryRepository();
    }

    /**
     * @test
     */
    public function the_rover_keeps_its_position_with_no_particular_instruction(): void
    {
        $sut = $this->getRoverService();

        $sut->order(new Order(new Position(1, 2, Cardinal::North), []));

        $expected = new Position(1, 2, Cardinal::North);
        $this->assertEquals($expected, $this->repository->get(0));
    }

    /**
     * @test
     * @dataProvider moveForwardProvider
     */
    public function the_rover_moves_forward(Position $originPosition, Position $destinationPosition): void
    {
        $sut = $this->getRoverService();

        $sut->order(new Order($originPosition, [Instruction::Move]));

        $this->assertEquals($destinationPosition, $this->repository->get(0));
    }

    /**
     * @test
     * @dataProvider turnLeftProvider
     */
    public function the_rover_turns_left(Cardinal $origin, Cardinal $destination): void
    {
        $sut = $this->getRoverService();

        $sut->order(new Order(new Position(1, 2, $origin), [Instruction::Left]));

        $expected = new Position(1, 2, $destination);
        $this->assertEquals($expected, $this->repository->get(0));
    }

    /**
     * @test
     */
    public function the_rover_follows_several_instructions(): void
    {
        $sut = $this->getRoverService();

        $sut->order(new Order(new Position(3, 3, Cardinal::East), [
            Instruction::Move,
            Instruction::Move,
            Instruction::Right,
            Instruction::Move,
            Instruction::Move,
            Instruction::Right,
            Instruction::Move,
            Instruction::Right,
            Instruction::Right,
            Instruction::Move,
        ]));

        $expected = new Position(5, 1, Cardinal::East);
        $this->assertEquals($expected, $this->repository->get(0));
    }

    /**
     * @test
     */
    public function several_rovers_are_ordered(): void
    {
        $sut = $this->getRoverService();

        $sut->order(
            new Order(new Position(1, 2, Cardinal::North), [
                Instruction::Left,
                Instruction::Move,
                Instruction::Left,
                Instruction::Move,
                Instruction::Left,
                Instruction::Move,
                Instruction::Left,
                Instruction::Move,
                Instruction::Move,
            ]),
            new Order(new Position(3, 3, Cardinal::East), [
                Instruction::Move,
                Instruction::Move,
                Instruction::Right,
                Instruction::Move,
                Instruction::Move,
                Instruction::Right,
                Instruction::Move,
                Instruction::Right,
                Instruction::Right,
                Instruction::Move,
            ])
        );

        $expected1 = new Position(1, 3, Cardinal::North);
        $expected2 = new Position(5, 1, Cardinal::East);
        $this->assertEquals($expected1, $this->repository->get(0));
        $this->assertEquals($expected2, $this->repository->get(1));
    }

    /**
     * @test
     * @dataProvider turnRightProvider
     */
    public function the_rover_turns_right(Cardinal $origin, Cardinal $destination): void
    {
        $sut = $this->getRoverService();

        $sut->order(new Order(new Position(1, 2, $origin), [Instruction::Right]));

        $expected = new Position(1, 2, $destination);
        $this->assertEquals($expected, $this->repository->get(0));
    }

    public static function moveForwardProvider()
    {
        return [
            [new Position(3, 3, Cardinal::North), new Position(3, 4, Cardinal::North)],
            [new Position(3, 3, Cardinal::West), new Position(2, 3, Cardinal::West)],
            [new Position(3, 3, Cardinal::South), new Position(3, 2, Cardinal::South)],
            [new Position(3, 3, Cardinal::East), new Position(4, 3, Cardinal::East)],
        ];
    }

    public static function turnLeftProvider()
    {
        return [
            'from north' => [Cardinal::North, Cardinal::West],
            'from west' => [Cardinal::West, Cardinal::South],
            'from south' => [Cardinal::South, Cardinal::East],
            'from east' => [Cardinal::East, Cardinal::North],
        ];
    }

    public static function turnRightProvider()
    {
        return [
            'from north' => [Cardinal::North, Cardinal::East],
            'from east' => [Cardinal::East, Cardinal::South],
            'from south' => [Cardinal::South, Cardinal::West],
            'from west' => [Cardinal::West, Cardinal::North],
        ];
    }

    /**
     * @return OrderMarsRoverService
     */
    public function getRoverService(): OrderMarsRoverService
    {
        return new OrderMarsRoverService(
            $this->repository,       );
    }
}
