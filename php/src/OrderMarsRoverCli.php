<?php

namespace KataStarter;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class OrderMarsRoverCli extends Command
{
    protected static $defaultDescription = 'Orders a series of rovers.';

    public function __construct(private OrderMarsRoverService $orderMarsRoverService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $help = <<<HELP
'This command allows you to order a series of rovers. For each rover, you must provide its initial position and a series of instructions. 

The initial position is composed of two integers and a cardinal letter. The integers represent the x and y coordinates of the rover. The cardinal letter represents the direction the rover is facing. The possible cardinal letters are: N (north), S (south), E (east) and W (west). 

The instructions are a series of letters. Each letter corresponds to an instruction. The possible instructions are: M (move forward), L (turn left) and R (turn right).'

For instance, to order 2 rovers, you would write:
    1 2 N
    LMLMLMLMM
    3 3 E
    MMRMMR
HELP;

        $this
            ->setName('order')
            ->setHelp($help)
        ;

        $this->setHelperSet(new HelperSet([
            'question' => new QuestionHelper(),
        ]));
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $question = new Question('Which orders do you want to send? (CTRL+D to end the input)');
        $question->setMultiline(true);

        $answer = $helper->ask($input, $output, $question);
        $orders = $this->parseOrders($answer);

        $this->orderMarsRoverService->order(...$orders);

        $output->writeln('');
        $output->writeln('Orders sent to the rovers...');
        $output->writeln('');
        $output->writeln('Rovers in positions:');

        foreach ($this->orderMarsRoverService->currentPositions() as $currentPosition) {
            $output->writeln($currentPosition);
        }

        return Command::SUCCESS;
    }

    /**
     * @return Order[]
     */
    private function parseOrders(string $input): array
    {
        $rawOrders = explode("\n", trim($input));
        $orders = [];

        for ($i = 0; $i < count($rawOrders); $i += 2) {
            $position = $this->parsePosition($rawOrders[$i]);
            $instructions = $this->parseInstructions($rawOrders[$i + 1]);

            $orders[] = new Order($position, $instructions);
        }

        return $orders;
    }

    private function parsePosition(string $input): Position
    {
        $rawPosition = explode(' ', $input);

        $x = (int)$rawPosition[0];
        $y = (int)$rawPosition[1];
        $direction = Cardinal::from($rawPosition[2]);

        return new Position($x, $y, $direction);
    }

    /**
     * @return Instruction[]
     */
    private function parseInstructions(string $input): array
    {
        $instructions = [];

        foreach (str_split($input) as $rawInstruction) {
            $instructions[] = Instruction::from($rawInstruction);
        }

        return $instructions;
    }
}
