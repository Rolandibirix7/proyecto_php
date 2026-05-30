<?php

use App\Models\Herramienta;
use App\Models\Prestamo;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('compartidas.index');
})->name('home');

// Rutas de administración y listado con datos reales de Eloquent
Route::get('/admin/dashboard', function () {
    $herramientas = Herramienta::all()->map(function ($h) {
        // Mapear estado para que coincida con la capitalización del JS anterior
        $estadoFormateado = 'Disponible';
        if ($h->estado === 'prestado') {
            $estadoFormateado = 'Prestado';
        } elseif ($h->estado === 'mantenimiento') {
            $estadoFormateado = 'Mantenimiento';
        }

        return [
            'id' => $h->id,
            'codigo' => $h->codigo,
            'nombre' => $h->nombre,
            'categoria' => $h->categoria,
            'estado' => $estadoFormateado,
            'titular' => $h->titular ?? 'Bodega',
        ];
    });

    $prestamos = Prestamo::with(['user', 'herramienta'])->get()->map(function ($p) {
        return [
            'id' => $p->id,
            'empleado' => $p->user ? $p->user->name : 'Desconocido',
            'carnet' => $p->user ? $p->user->carnet : '—',
            'herramientaId' => $p->herramienta_id,
            'herramientaNombre' => $p->herramienta ? $p->herramienta->nombre : 'Herramienta Eliminada',
            'inicio' => $p->fecha_prestamo,
            'vence' => $p->fecha_devolucion_esperada,
            'estado' => $p->estado,
        ];
    });

    return view('administrador.dashboard', compact('herramientas', 'prestamos'));
})->name('admin.dashboard');

Route::get('/listado', function () {
    $herramientas = Herramienta::all()->map(function ($h) {
        return [
            'id' => $h->id,
            'codigo' => $h->codigo,
            'nombre' => $h->nombre,
            'categoria' => $h->categoria,
            'estado' => $h->estado,
            'titular' => $h->titular ?? 'Bodega',
        ];
    });

    return view('compartidas.lista', compact('herramientas'));
})->name('compartidas.lista');
