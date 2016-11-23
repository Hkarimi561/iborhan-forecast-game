<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Forecast
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $home_point
 * @property integer $away_point
 * @property integer $user_id
 * @property integer $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Forecast whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Forecast whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Forecast whereHomePoint($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Forecast whereAwayPoint($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Forecast whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Forecast whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Forecast whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Forecast whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Game $game
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Forecast whereUserId($value)
 */
class Forecast extends Model
{
    protected $table = 'forecast';
    use SoftDeletes;
    protected $fillable = [
        'game_id',
        'home_point',
        'away_point',
        'user_id',
        'status'
    ];
    public function game()
    {
        return $this->belongsTo(Game::class ,'game_id','id');
    }
}
