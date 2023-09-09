<?php

namespace KataStarter;

use Symfony\Component\Filesystem\Filesystem;

final class MarsRoverPositionJsonRepository
{
    private Filesystem $fs;

    public function __construct(private string $filename)
    {
        $this->fs = new Filesystem();
    }

    public function add(Position $position): void
    {
        $actualPositions = json_decode(file_get_contents($this->filename)) ?? [];
        $actualPositions[] = $position;

        $this->fs->dumpFile($this->filename, json_encode($actualPositions));
    }

    public function get(int $index): Position
    {
        $positions = json_decode(file_get_contents($this->filename)) ?? [];

        $position = $positions[$index];

        return new Position($position->x, $position->y, Cardinal::from($position->direction) );
    }
}
