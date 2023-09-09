<?php

namespace KataStarter\Test\AlmostHidden;

use KataStarter\Cardinal;
use KataStarter\MarsRoverPositionJsonRepository;
use KataStarter\Position;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class MarsRoverPositionJsonRepositoryTest extends TestCase
{
    private string $filename;

    protected function setUp(): void
    {
        parent::setUp();

        $this->filename = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid('mars-rover-positions.json');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        if (file_exists($this->filename)) {
            unlink($this->filename);
        }
    }

    /**
     * @test
     */
    public function it_saves_mars_rover_positions_to_a_json_file(): void
    {
        $sut = new MarsRoverPositionJsonRepository($this->filename);

        $sut->add(new Position(0, 0, Cardinal::North));
        $sut->add(new Position(1, 0, Cardinal::East));
        $sut->add(new Position(1, -1, Cardinal::South));
        $sut->add(new Position(0, -1, Cardinal::West));

        $this->assertFileExists($this->filename);
        $this->assertJsonStringEqualsJsonFile($this->filename, '[
            {"x":0,"y":0,"direction":"N"},
            {"x":1,"y":0,"direction":"E"},
            {"x":1,"y":-1,"direction":"S"},
            {"x":0,"y":-1,"direction":"W"}
        ]');
    }

    /**
     * @test
     */
    public function it_gets_a_mars_rover_position_from_a_json_file(): void
    {
        $fs = new Filesystem();
        $fs->dumpFile($this->filename, '[
            {"x":0,"y":0,"direction":"N"},
            {"x":1,"y":0,"direction":"E"},
            {"x":1,"y":-1,"direction":"S"},
            {"x":0,"y":-1,"direction":"W"}
        ]');

        $sut = new MarsRoverPositionJsonRepository($this->filename);

        $this->assertEquals(
            new Position(1, 0, Cardinal::East),
            $sut->get(1)
        );
    }
}
