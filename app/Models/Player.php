<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Player
 *
 * @property integer $id
 * @property string $name
 * @property integer $team_id
 * @property integer $number
 * @property integer $age
 * @property integer $height
 * @property integer $weight
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Player whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Player whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Player whereTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Player whereNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Player whereAge($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Player whereHeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Player whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Player whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Player whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Player extends Model
{
    protected $table = 'player';
    use SoftDeletes;
    protected $fillable = [
        'name',
        'team_id',
        'number',
        'age',
        'height',
        'weight'
    ];
    public function event(){
        return $this->hasMany(GameEvent::class,'id','player_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class ,'team_id','id');
    }
}
