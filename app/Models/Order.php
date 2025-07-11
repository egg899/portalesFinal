<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['usuario_id', 'total', 'status'];


    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }



}
