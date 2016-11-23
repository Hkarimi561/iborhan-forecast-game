<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FootballETicket extends Model
{
    protected $table = 'football_e_ticket';
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'username',
        'password',
        'validate'
    ];
}
