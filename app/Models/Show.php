<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $fillable = ['show_date', 'show_time', 'user_id', 'available_users', 'restaurant_id'];

    protected $casts = [
        'show_date' => 'date',
        'show_time' => 'string',
        'available_users' => 'array',
        'restaurant_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
