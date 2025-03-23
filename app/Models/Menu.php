<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'logo',
        'name',
        'description',
        'background_image',
        'order',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
