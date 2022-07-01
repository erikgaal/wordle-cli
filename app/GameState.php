<?php

namespace App;

class GameState
{
    public function __construct(
        public readonly int $remaining_attempts,
    ) {
    }

    public static function new(int $attempts)
    {
    }

    public static function lost(): self
    {
        return new GameState(
            remaining_attempts: 0,
        );
    }
}
