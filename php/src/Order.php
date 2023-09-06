<?php

namespace KataStarter;

class Order
{
    public function __construct(public Position $initialPosition, public array $instructions)
    {
    }
}
