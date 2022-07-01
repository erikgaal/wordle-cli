<?php

namespace App;

class Attempt
{
    public function __construct(
        public readonly string $word,
        public readonly array  $hints,
    )
    {
    }
}
