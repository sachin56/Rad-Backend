<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetSitterRequest extends Model
{
    protected $fillable = [
        'user_id',
        'pet_id',
        'pet_sitter_id',
        'status',
        'note',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function user()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

}
