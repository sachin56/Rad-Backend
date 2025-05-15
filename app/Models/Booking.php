<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'pet_id',
        'clinic_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
