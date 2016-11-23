<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\City
 *
 * @property integer $id
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\City whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\City whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\City whereLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\City whereLongitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\City whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\City whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\City whereDeletedAt($value)
 * @mixin \Eloquent
 */
class City extends Model
{
    protected $table = 'city';
    use SoftDeletes;
    protected $fillable = [
        'name',
        'longitude',
        'latitude'
    ];
}
