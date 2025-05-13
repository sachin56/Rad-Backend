<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'pet_id',
        'doctor_id',
        'appointment_time_id',
        'location_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
