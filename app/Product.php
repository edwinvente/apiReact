<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'category_id', 'name', 'reference', 'price', 'size', 'stock', 'status',
    ];
}
