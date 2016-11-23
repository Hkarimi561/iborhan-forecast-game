<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Game
 *
 * @property integer $id
 * @property integer $home_id
 * @property integer $away_id
 * @property integer $stadium_id
 * @property string $game_time
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \App\Models\Team $away_team
 * @property-read \App\Models\Team $home_team
 * @property-read \App\Models\Stadium $stadium
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereHomeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereAwayId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereStadiumId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereGameTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Forecast[] $forecast
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ForecastQuestion[] $forecast_question
 */
class Game extends Model
{
    protected $table = 'game';
    use SoftDeletes;
    protected $fillable = [
        'home_id',
        'away_id',
        'stadium_id',
        'game_time'
    ];
    public function away_team()
    {
        return $this->belongsTo(Team::class,'away_id','id');
    }
    public function home_team()
    {
        return $this->belongsTo(Team::class ,'home_id','id');
    }
    public function stadium()
    {
        return $this->belongsTo(Stadium::class);
    }
    public function forecast()
    {
        return $this->hasMany(Forecast::class);
    }
    public function forecast_question()
    {
        return $this->hasMany(ForecastQuestion::class);
    }
    public function game_event()
    {
        return $this->hasMany(GameEvent::class);
    }

}
