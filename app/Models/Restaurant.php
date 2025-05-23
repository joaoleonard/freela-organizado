<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function shows()
    {
        return $this->hasMany(Show::class);
    }

    public function musicians()
    {
        return $this->belongsToMany(User::class, 'musician_restaurant');
    }
}
