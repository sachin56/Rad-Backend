<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinics extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'logo',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
