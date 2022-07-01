<?php

namespace App;

use Illuminate\Support\Str;

class WordleChecker
{
    public static function guess(string $word, string $guess): array
    {
        $remainingLetters = str_split($word);

        return collect(str_split($guess))
            ->map(function (string $letter, int $position) use (&$remainingLetters, $word) {
                // First we have to pick out all CORRECT letters.
                $expectedLetter = substr($word, $position, 1);

                if ($expectedLetter === $letter) {
                    unset($remainingLetters[$position]);
                    return Hint::Correct;
                }

                return $letter;
            })->map(function (string|Hint $letter, int $position) use (&$remainingLetters) {
                // Then we can check for any PRESENT letters.
                if ($letter instanceof Hint) return $letter;

                if ($index = array_search($letter, $remainingLetters)) {
                    unset($remainingLetters[$index]);
                    return Hint::Present;
                }

                return Hint::Absent;
            })->toArray();
    }
}
