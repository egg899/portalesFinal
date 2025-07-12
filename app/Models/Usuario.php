<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = ['username',  'email', 'password', 'role'];

    protected $hidden = ['password'];



    public function compras()
    {
        return $this->hasMany(Compra::class, 'usuario_id');
    }


    public function ordenes()
    {
        return $this->hasMany(Order::class, 'usuario_id');
    }


   protected static function booted(): void
    {
        static::deleting(function ($usuario) {
            $usuario->compras()->delete();
        });
    }
 }
