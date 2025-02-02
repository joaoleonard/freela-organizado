<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $fillable = ['show_date', 'user_id', 'available_users'];

    protected $casts = [
        'show_date' => 'date',
        'available_users' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
