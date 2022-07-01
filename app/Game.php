<?php

namespace App;

use Illuminate\Support\Str;

class Game
{
    const MAX_ATTEMPTS = 6;

    protected ?string $word = null;

    protected array $attempts = [];

    public function __construct(
        protected ProvidesWords $words,
    )
    {
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function getAttempts(): array
    {
        return $this->attempts;
    }

    public function getRemainingAttempts(): int
    {
        return self::MAX_ATTEMPTS - count($this->attempts);
    }

    public function hasRemainingAttempts(): bool
    {
        return $this->getRemainingAttempts() > 0;
    }

    public function start()
    {
        if (!$this->word) {
            $this->word = Str::lower($this->words->next());
        }

        return $this;
    }

    public function guess(string $guess): bool
    {
        if (!$this->word) {
            $this->start();
        }

        if (!$this->words->validate($guess)) {
            return false;
        }

        $this->attempts[] = $this->attempt($guess);

        return true;
    }

    protected function attempt(string $guess): Attempt
    {
        $hints = WordleChecker::guess($this->word, $guess);

        return new Attempt(
            word: $guess,
            hints: $hints,
        );
    }
}
