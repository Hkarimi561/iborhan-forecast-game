<?php

namespace App\Console\Commands;

use App\Models\Games;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
class GetGamesCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "games";

    /**
     * @var string Command Description
     */
    protected $description = "Get All of Games";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $this->replyWithMessage(['text' => 'This is the game of this week:']);

        // This will update the chat status to typing...
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $games=Games::where('score',null)->get()->toArray();
        $game_response='';
        foreach ($games as $game){
            $game_response=sprintf('/%s - %s' . PHP_EOL, $game->home.'-'.$game->away, $game->time);
        }
        $this->replyWithMessage(['text' => $game_response]);

    }
}
