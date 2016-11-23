<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ForecastQuestion
 *
 * @property integer $id
 * @property integer $forecast_id
 * @property integer $question_id
 * @property integer $answer_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ForecastQuestion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ForecastQuestion whereForecastId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ForecastQuestion whereQuestionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ForecastQuestion whereAnswerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ForecastQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ForecastQuestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ForecastQuestion whereDeletedAt($value)
 * @mixin \Eloquent
 * @property integer $game_id
 * @property-read \App\Models\Game $game
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ForecastQuestion whereGameId($value)
 */
class ForecastQuestion extends Model
{
    protected $table = 'forecast_question';
    use SoftDeletes;
    public $json;
    protected $fillable = [
        'game_id',
        'question_id',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }


}
