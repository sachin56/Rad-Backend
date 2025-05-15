<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Veterinarian extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    protected $guard_name = 'veterinarians';

    protected $fillable = [
        'name',
        'email',
        'clinic_id',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}

