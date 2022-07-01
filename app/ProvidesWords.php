<?php

namespace App;

interface ProvidesWords
{
    public function validate(string $word): bool;

    public function next(): string;
}
