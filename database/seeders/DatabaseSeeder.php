<?php

namespace Database\Seeders;

use App\Models\Herramienta;
use App\Models\Prestamo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Roles
        $adminRole = Role::create(['name' => 'admin']);
        $empleadoRole = Role::create(['name' => 'empleado']);

        // 2. Seed Users/Employees
        $adminUser = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'carnet' => 'ADM001',
            'role_id' => $adminRole->id,
        ]);

        $carlos = User::create([
            'name' => 'Carlos Ruiz',
            'email' => 'carlos@example.com',
            'password' => Hash::make('password'),
            'carnet' => 'CR001',
            'role_id' => $empleadoRole->id,
        ]);

        $laura = User::create([
            'name' => 'Laura Gómez',
            'email' => 'laura@example.com',
            'password' => Hash::make('password'),
            'carnet' => 'LG002',
            'role_id' => $empleadoRole->id,
        ]);

        $jorge = User::create([
            'name' => 'Jorge Méndez',
            'email' => 'jorge@example.com',
            'password' => Hash::make('password'),
            'carnet' => 'JM003',
            'role_id' => $empleadoRole->id,
        ]);

        $ana = User::create([
            'name' => 'Ana Pereira',
            'email' => 'ana@example.com',
            'password' => Hash::make('password'),
            'carnet' => 'AP004',
            'role_id' => $empleadoRole->id,
        ]);

        $roberto = User::create([
            'name' => 'Roberto Díaz',
            'email' => 'roberto@example.com',
            'password' => Hash::make('password'),
            'carnet' => 'RD005',
            'role_id' => $empleadoRole->id,
        ]);

        // 3. Seed Herramientas
        $h1 = Herramienta::create([
            'codigo' => 'H-001',
            'nombre' => 'Taladro percutor',
            'categoria' => 'Eléctrica',
            'estado' => 'disponible',
            'titular' => 'Bodega',
        ]);

        $h2 = Herramienta::create([
            'codigo' => 'H-002',
            'nombre' => 'Sierra circular',
            'categoria' => 'Eléctrica',
            'estado' => 'prestado',
            'titular' => 'Carlos Ruiz',
        ]);

        $h3 = Herramienta::create([
            'codigo' => 'H-003',
            'nombre' => 'Llave de impacto',
            'categoria' => 'Neumática',
            'estado' => 'disponible',
            'titular' => 'Bodega',
        ]);

        $h4 = Herramienta::create([
            'codigo' => 'H-004',
            'nombre' => 'Amoladora angular',
            'categoria' => 'Eléctrica',
            'estado' => 'prestado',
            'titular' => 'Laura Gómez',
        ]);

        $h5 = Herramienta::create([
            'codigo' => 'H-005',
            'nombre' => 'Cinta métrica láser',
            'categoria' => 'Medición',
            'estado' => 'disponible',
            'titular' => 'Bodega',
        ]);

        $h6 = Herramienta::create([
            'codigo' => 'H-006',
            'nombre' => 'Compresor 50L',
            'categoria' => 'Neumática',
            'estado' => 'mantenimiento',
            'titular' => 'Taller',
        ]);

        $h7 = Herramienta::create([
            'codigo' => 'H-007',
            'nombre' => 'Atornillador eléctrico',
            'categoria' => 'Eléctrica',
            'estado' => 'disponible',
            'titular' => 'Bodega',
        ]);

        $h8 = Herramienta::create([
            'codigo' => 'H-008',
            'nombre' => 'Nivel láser',
            'categoria' => 'Medición',
            'estado' => 'disponible',
            'titular' => 'Bodega',
        ]);

        $h9 = Herramienta::create([
            'codigo' => 'H-009',
            'nombre' => 'Hidrolavadora',
            'categoria' => 'Limpieza',
            'estado' => 'disponible',
            'titular' => 'Bodega',
        ]);

        $h10 = Herramienta::create([
            'codigo' => 'H-010',
            'nombre' => 'Martillo demoledor',
            'categoria' => 'Eléctrica',
            'estado' => 'prestado',
            'titular' => 'Jorge Méndez',
        ]);

        // 4. Seed Prestamos
        Prestamo::create([
            'user_id' => $carlos->id,
            'herramienta_id' => $h2->id,
            'fecha_prestamo' => '2026-05-10',
            'fecha_devolucion_esperada' => '2026-06-07',
            'fecha_devolucion_real' => null,
            'estado' => 'activo',
            'plazo' => '4 semanas',
            'observaciones' => 'Proyecto de remodelación de oficina principal',
        ]);

        Prestamo::create([
            'user_id' => $laura->id,
            'herramienta_id' => $h4->id,
            'fecha_prestamo' => '2026-05-12',
            'fecha_devolucion_esperada' => '2026-06-09',
            'fecha_devolucion_real' => null,
            'estado' => 'activo',
            'plazo' => '4 semanas',
            'observaciones' => 'Instalación de paneles en área de producción',
        ]);

        Prestamo::create([
            'user_id' => $jorge->id,
            'herramienta_id' => $h10->id,
            'fecha_prestamo' => '2026-05-18',
            'fecha_devolucion_esperada' => '2026-06-15',
            'fecha_devolucion_real' => null,
            'estado' => 'activo',
            'plazo' => '4 semanas',
            'observaciones' => 'Demolición de muro secundario en almacén',
        ]);

        Prestamo::create([
            'user_id' => $ana->id,
            'herramienta_id' => $h7->id,
            'fecha_prestamo' => '2026-04-01',
            'fecha_devolucion_esperada' => '2026-04-28',
            'fecha_devolucion_real' => '2026-04-28',
            'estado' => 'devuelto',
            'plazo' => '2 semanas',
            'observaciones' => 'Mantenimiento preventivo de racks de servidores',
        ]);

        Prestamo::create([
            'user_id' => $roberto->id,
            'herramienta_id' => $h5->id,
            'fecha_prestamo' => '2026-05-01',
            'fecha_devolucion_esperada' => '2026-05-28',
            'fecha_devolucion_real' => '2026-05-28',
            'estado' => 'devuelto',
            'plazo' => '3 días',
            'observaciones' => 'Medición de distancias en nuevo local comercial',
        ]);
    }
}
