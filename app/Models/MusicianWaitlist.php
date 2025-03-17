<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicianWaitlist extends Model
{
    protected $table = 'musicians_waitlist';
    protected $fillable = ['name', 'description', 'instagram', 'phone', 'extra_link'];
}
