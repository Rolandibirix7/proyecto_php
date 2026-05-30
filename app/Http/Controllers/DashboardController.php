<?php

namespace App\Http\Controllers;

use App\Models\Herramienta;
use App\Models\Prestamo;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with real statistics.
     */
    public function index()
    {
        $herramientas = Herramienta::all();
        $prestamosActivos = Prestamo::where('estado', 'activo')->with(['user', 'herramienta'])->get();

        // Estadísticas
        $totalHerramientas = $herramientas->count();
        $countActivos = $prestamosActivos->count();

        // Vencen esta semana
        $inicioSemana = now()->startOfWeek();
        $finSemana = now()->endOfWeek();
        $vencenEstaSemana = Prestamo::where('estado', 'activo')
            ->whereBetween('fecha_devolucion_esperada', [$inicioSemana, $finSemana])
            ->count();

        // Devueltos este mes
        $devueltosEsteMes = Prestamo::where('estado', 'devuelto')
            ->whereMonth('fecha_devolucion_real', now()->month)
            ->whereYear('fecha_devolucion_real', now()->year)
            ->count();

        // Herramientas disponibles (para la tabla de "disponibles")
        $disponibles = $herramientas->where('estado', 'disponible')->take(5);

        return view('administrador.dashboard', compact(
            'totalHerramientas',
            'countActivos',
            'vencenEstaSemana',
            'devueltosEsteMes',
            'prestamosActivos',
            'disponibles',
        ));
    }
}
