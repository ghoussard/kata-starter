<?php

namespace KataStarter\Test;

use KataStarter\Cardinal;
use KataStarter\Instruction;
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

        $sut->order(new Position(1, 2, Cardinal::North), []);

        $expected = new Position(1, 2, Cardinal::North);
        $this->assertEquals($expected, $sut->currentPosition());
    }

    /**
     * @test
     */
    public function the_rover_moves_forward(): void
    {
        $sut = new OrderMarsRoverService();

        $sut->order(new Position(1, 2, Cardinal::North), [Instruction::Move]);

        $expected = new Position(1, 3, Cardinal::North);
        $this->assertEquals($expected, $sut->currentPosition());
    }

    /**
     * @test
     * @dataProvider turnLeftProvider
     */
    public function the_rover_turns_left(Cardinal $origin, Cardinal $destination): void
    {
        $sut = new OrderMarsRoverService();

        $sut->order(new Position(1, 2, $origin), [Instruction::Left]);

        $expected = new Position(1, 2, $destination);
        $this->assertEquals($expected, $sut->currentPosition());
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

    /**
     * @test
     * @dataProvider turnRightProvider
     */
    public function the_rover_turns_right(Cardinal $origin, Cardinal $destination): void
    {
        $sut = new OrderMarsRoverService();

        $sut->order(new Position(1, 2, $origin), [Instruction::Right]);

        $expected = new Position(1, 2, $destination);
        $this->assertEquals($expected, $sut->currentPosition());
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
