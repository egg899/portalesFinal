<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Blog extends Model
{
    protected $table = 'blogs';      // Le decís a Laravel qué tabla usar (útil si no sigue la convención)
    protected $primaryKey = 'id';
    protected $fillable = ['titulo', 'resumen', 'contenido', 'autor', 'imagen', 'categoria', 'rating_fk'];
    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function rating(): BelongsTo

    {
        return $this->belongsTo(Rating::class, 'rating_fk', 'rating_id');
    }


    public function categorias(): belongsToMany
    {
        return $this->belongsToMany(
        Categorias::class,           // Modelo relacionado
        'blogs_have_categorias',     // Tabla intermedia
        'blogs_fk',                  // Foreign key de este modelo en la tabla intermedia
        'categoria_fk',             // Foreign key del modelo relacionado
        'id',                        // Clave local en este modelo
        'categoria_id',             // Clave local del modelo relacionado
    );
    }


}
