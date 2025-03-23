<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, HasApiTokens,Notifiable; 
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'social_id',
        'profile_image',
        'status',
        'social_provider',
        'email_verified_at',
        'phone_verified_at',
        'password',
    ];


    // public function hasRole($roleName)
    // {
    //     return $this->roles->contains('name', $roleName);
    // }

    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }
}
