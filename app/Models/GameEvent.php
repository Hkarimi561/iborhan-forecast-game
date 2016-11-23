<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\GameEvent
 *
 * @property integer $id
 * @property string $type
 * @property integer $player_id
 * @property integer $team_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GameEvent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GameEvent whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GameEvent wherePlayerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GameEvent whereTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GameEvent whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GameEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GameEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GameEvent whereDeletedAt($value)
 * @mixin \Eloquent
 */
class GameEvent extends Model
{
    protected $table = 'game_event';
    use SoftDeletes;
    protected $fillable = [
        'type',
        'player_id',
        'team_id',
        'game_id',
        'event_time'
    ];
    public function game()
    {
        return $this->belongsTo(Game::class,'game_id','id');
    }
    public function team()
    {
        return $this->belongsTo(Team::class,'team_id','id');
    }
    public function player()
    {
        return $this->belongsTo(Player::class,'player_id','id');
    }

}
