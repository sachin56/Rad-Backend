<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopProduct extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'category_id',
        'shop_id',
        'name',
        'description',
        'image',
        'price',
        'quantity',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
