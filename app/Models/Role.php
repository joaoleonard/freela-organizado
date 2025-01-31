<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'type',
    ];

    /**
     * Get translated type.
     */
    public function getFormattedType(): string
    {
        return match ($this->type) {
            'master' => 'Master',
            'admin' => 'Administrador',
            default => 'Músico',
        };
    }
}
