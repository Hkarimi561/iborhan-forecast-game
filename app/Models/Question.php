<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Question
 *
 * @property integer $id
 * @property string $type
 * @property string $question
 * @property string $event
 * @property string $answer
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereQuestion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereEvent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereAnswer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Question extends Model
{
    protected $table = 'question';
    use SoftDeletes;
    protected $fillable = [
        'type',
        'question',
        'event',
    ];
}
