<?php

namespace KataStarter\Test\AlmostHidden;

use KataStarter\MarsRoverPositionInMemoryRepository;
use KataStarter\OrderMarsRoverCli;
use KataStarter\OrderMarsRoverService;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class OrderMarsRoverCliTest extends TestCase
{
    private CommandTester $commandTester;
    private OrderMarsRoverCli $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new OrderMarsRoverCli(new OrderMarsRoverService(
            new MarsRoverPositionInMemoryRepository()
        ));
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
        Assert::assertSame(<<<EOL
Which orders do you want to send? (CTRL+D to end the input)
Orders sent to the rovers...

EOL, $output);
    }
}
