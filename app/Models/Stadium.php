<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Stadium
 *
 * @property integer $id
 * @property string $name
 * @property integer $seat_count
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \App\Models\Game $game
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Stadium whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Stadium whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Stadium whereSeatCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Stadium whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Stadium whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Stadium whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Stadium extends Model
{
    protected $table = 'stadium';
    use SoftDeletes;
    protected $fillable = [
        'name',
        'seat_count'
    ];
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
