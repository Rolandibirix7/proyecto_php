<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestamo extends Model
{
    protected $fillable = [
        'user_id',
        'herramienta_id',
        'fecha_prestamo',
        'fecha_devolucion_esperada',
        'fecha_devolucion_real',
        'estado',
        'plazo',
        'observaciones',
    ];

    /**
     * Get the user that made the loan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tool that was loaned.
     */
    public function herramienta(): BelongsTo
    {
        return $this->belongsTo(Herramienta::class);
    }
}
