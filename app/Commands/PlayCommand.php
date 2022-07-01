<?php

namespace App\Commands;

use App\Game;
use App\ProvidesWords;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Str;
use LaravelZero\Framework\Commands\Command;
use function Termwind\ask;
use function Termwind\render;
use function Termwind\terminal;

class PlayCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'play';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $game = app(Game::class);

        while (true) {
            terminal()->clear();
            $this->renderGame($game);

            if ($game->hasRemainingAttempts()) {
                $game->guess(Str::lower(ask("Enter your guess ({$game->getRemainingAttempts()} attempts remaining): ")));
            } else {
                break;
            }
        }

        render("The correct word was: {$game->getWord()}");

        return self::SUCCESS;
    }

    protected function renderGame(Game $game): void
    {
        terminal()->clear();
        render(view('game', ['game' => $game]));
    }
}
