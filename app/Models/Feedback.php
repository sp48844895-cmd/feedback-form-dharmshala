<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'name',
        'mobile',
        'overall_experience',
        'cleanliness',
        'room_condition',
        'bathroom_cleanliness',
        'staff_behaviour',
        'basic_facilities',
        'money_return',
        'stay_again',
        'recommend',
        'suggestions',
    ];
}
