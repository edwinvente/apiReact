<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = "detail_sales";

    protected $fillable = [
        'product_id', 'sale_id', 'quantity',
    ];
}
