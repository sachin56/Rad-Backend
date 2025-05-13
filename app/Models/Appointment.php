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
        'appointment_status',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id', 'id');
    }

    public function appointmentTime()
    {
        return $this->belongsTo(DoctorBookingTime::class, 'appointment_time_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(DoctorLocation::class, 'location_id', 'id');
    }
}
