<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ebook extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'pet_id',
        'title',
        'attachment',
        'description',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function petName()
    {
        return $this->belongsTo(Pet::class, 'pet_id','id');
    }
}
