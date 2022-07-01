<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use RuntimeException;

class UnixWordsProvider implements ProvidesWords
{
    public Collection $words;

    public function __construct(
        public readonly string $filename = '/usr/share/dict/words',
        public readonly int    $character_count = 5,
    ) {
    }

    public function validate(string $word): bool
    {
        $command = sprintf('cat %s | grep -E "^.{%d}$" | grep %s', escapeshellarg($this->filename), $this->character_count, $word);

        exec($command, $output);

        return ! empty($output);
    }

    public function next(): string
    {
        $command = sprintf('shuf %s | grep -E "^.{%d}$" | head -n 1', escapeshellarg($this->filename), $this->character_count);

        exec($command, $output);

        return $output[0] ?? throw new RuntimeException("Unable to find a {$this->character_count}-letter word in [{$this->filename}]");
    }
}
