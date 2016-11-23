<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Answer
 *
 * @property integer $id
 * @property integer $forecast_question_id
 * @property integer $user_id
 * @property string $answer
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Answer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Answer whereForecastQuestionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Answer whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Answer whereAnswer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Answer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Answer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Answer whereDeletedAt($value)
 * @mixin \Eloquent
 * @property integer $forecast_id
 * @property integer $question_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Answer whereForecastId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Answer whereQuestionId($value)
 */
class Answer extends Model
{
    protected $table = 'answer';
    use SoftDeletes;
    protected $fillable = [
        'forecast_id',
        'answer'
    ];
}
