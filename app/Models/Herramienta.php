<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Herramienta extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'categoria',
        'estado',
        'titular',
    ];

    /**
     * Get the loans for this tool.
     */
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class);
    }
}
