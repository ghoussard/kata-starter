<?php

namespace KataStarter\Test;

use KataStarter\Cardinal;
use KataStarter\Instruction;
use KataStarter\Order;
use KataStarter\OrderMarsRoverService;
use KataStarter\Position;
use PHPUnit\Framework\TestCase;

class OrderMarsRoverServiceTest extends TestCase
{
    /**
     * @test
     */
    public function the_rover_keeps_its_position_with_no_particular_instruction(): void
    {
        $sut = new OrderMarsRoverService();

        $sut->order(new Order(new Position(1, 2, Cardinal::North), []));

        $expected = new Position(1, 2, Cardinal::North);
        $this->assertEquals($expected, $sut->currentPosition());
    }

    /**
     * @test
     * @dataProvider moveForwardProvider
     */
    public function the_rover_moves_forward(Position $originPosition, Position $destinationPosition): void
    {
        $sut = new OrderMarsRoverService();

        $sut->order(new Order($originPosition, [Instruction::Move]));

        $this->assertEquals($destinationPosition, $sut->currentPosition());
    }

    /**
     * @test
     * @dataProvider turnLeftProvider
     */
    public function the_rover_turns_left(Cardinal $origin, Cardinal $destination): void
    {
        $sut = new OrderMarsRoverService();

        $sut->order(new Order(new Position(1, 2, $origin), [Instruction::Left]));

        $expected = new Position(1, 2, $destination);
        $this->assertEquals($expected, $sut->currentPosition());
    }

    /**
     * @test
     */
    public function the_rover_follows_several_instructions(): void
    {
        $sut = new OrderMarsRoverService();

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
        $this->assertEquals($expected, $sut->currentPosition());
    }

    /**
     * @test
     * @dataProvider turnRightProvider
     */
    public function the_rover_turns_right(Cardinal $origin, Cardinal $destination): void
    {
        $sut = new OrderMarsRoverService();

        $sut->order(new Order(new Position(1, 2, $origin), [Instruction::Right]));

        $expected = new Position(1, 2, $destination);
        $this->assertEquals($expected, $sut->currentPosition());
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
}
