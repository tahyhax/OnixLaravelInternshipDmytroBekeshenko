<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\OrderItem
 *
 * @mixin \Eloquent
 */
class OrderItem extends Pivot
{
    use HasFactory;


    protected $fillable = [
        'qty', 'product_id', 'order_id',
    ];
}
