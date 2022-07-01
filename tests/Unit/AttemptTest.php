<?php

use App\Hint;
use App\WordleChecker;

it('tests', function (string $word, string $guess, array $expected) {
    expect(WordleChecker::guess($word, $guess))->toBe($expected);
})->with([
    [
        'A????',
        'AAAAA',
        [Hint::Correct, Hint::Absent, Hint::Absent, Hint::Absent, Hint::Absent],
    ],
    [
        'A???A',
        'AAABB',
        [Hint::Correct, Hint::Present, Hint::Absent, Hint::Absent, Hint::Absent],
    ],
    [
        '????A',
        'ABBBB',
        [Hint::Present, Hint::Absent, Hint::Absent, Hint::Absent, Hint::Absent],
    ],
    [
        '????A',
        'ABBBA',
        [Hint::Absent, Hint::Absent, Hint::Absent, Hint::Absent, Hint::Correct],
    ],
]);
