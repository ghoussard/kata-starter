<?php

namespace KataStarter\Test;

use KataStarter\OrderMarsRoverService;
use PHPUnit\Framework\TestCase;

class OrderMarsRoverServiceTest extends TestCase
{
    /**
     * @test
     */
    public function the_rover_keeps_its_position_with_no_particular_instruction(): void
    {
        $sut = new OrderMarsRoverService();

        $sut->order('1 2 N', '');

        $this->assertEquals('1 2 N', $sut->currentPosition());
    }
}
