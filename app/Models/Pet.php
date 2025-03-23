<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'logo',
        'name',
        'age',
        'breed',
        'gender',
        'weight',
        'medical_condition',
        'addition_note',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function userName()
    {
        return $this->belongsTo(Customer::class, 'user_id','id');
    }
}
