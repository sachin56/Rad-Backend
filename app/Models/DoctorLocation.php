<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorLocation extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'doctor_id',
        'location',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function doctor()
    {
        return $this->belongsTo(Veterinarian::class, 'doctor_id', 'id')->orderBy('id', 'asc');

    }
}
