<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopCategory extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'shop_id',
        'name',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
