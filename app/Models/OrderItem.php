<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'producto_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }


}
