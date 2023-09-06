<?php

namespace KataStarter\Test;

use KataStarter\Cardinal;
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

        $sut->order(new Position(1, 2, Cardinal::north()), '');

        $expected = new Position(1, 2, Cardinal::north());
        $this->assertEquals($expected, $sut->currentPosition());
    }

    /**
     * @test
     */
    public function the_rover_moves_forward(): void
    {
        $sut = new OrderMarsRoverService();

        $sut->order(new Position(1, 2, Cardinal::north()), 'M');

        $expected = new Position(1, 3, Cardinal::north());
        $this->assertEquals($expected, $sut->currentPosition());
    }
}
