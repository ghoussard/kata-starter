<?php

namespace KataStarter\Test\AlmostHidden;

use KataStarter\OrderMarsRoverCli;
use KataStarter\OrderMarsRoverService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class OrderMarsRoverCliTest extends TestCase
{
    private CommandTester $commandTester;
    private OrderMarsRoverCli $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new OrderMarsRoverCli(new OrderMarsRoverService());
        $this->commandTester = new CommandTester($this->command);
    }

    /**
     * @test
     */
    public function it_orders_rovers(): void
    {
        $orders = <<<ORDERS
1 2 N
LMLMLMLMM
3 3 E
MMRMMRMRRM
ORDERS;

        $this->commandTester->setInputs([$orders]);
        $this->commandTester->execute([]);

        $output = $this->commandTester->getDisplay();
        $this->assertStringContainsString('Which orders do you want to send? (CTRL+D to end the input)', $output);
        $this->assertStringContainsString('Orders sent to the rovers...', $output);
        $this->assertStringContainsString('Rovers in positions:', $output);
        $this->assertStringContainsString('1 3 N', $output);
        $this->assertStringContainsString('5 1 E', $output);
    }
}
