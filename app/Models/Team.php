<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Team
 *
 * @property integer $id
 * @property string $name
 * @property string $avatar
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $home_team
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $away_team
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereDeletedAt($value)
 * @mixin \Eloquent
 * @property string $url
 * @property integer $city_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereCityId($value)
 */
class Team extends Model
{
    protected $table = 'team';
    use SoftDeletes;
    protected $fillable = [
        'name',
        'avatar',
	    'url'
    ];
    public function home_team()
    {
        return $this->hasMany(Game::class,'id','home_id');
    }
    public function away_team()
    {
        return $this->hasMany(Game::class,'id','away_id');
    }
    public function event()
    {
        return $this->hasMany(GameEvent::class,'id','team_id');
    }
    public function player()
    {
        return $this->hasMany(Player::class,'team_id','id');
    }
}
