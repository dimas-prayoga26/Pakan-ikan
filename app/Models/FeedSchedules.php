<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedSchedules extends Model
{
    use HasFactory;
    protected $table = 'feed_schedules';
    protected $fillable = [
        'hourOne', 'minuteOne', 'hourTwo', 'minuteTwo', 'hourThree', 'minuteThree'
    ];
}
