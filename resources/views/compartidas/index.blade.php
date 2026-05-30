<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Inventory & Lending System</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Connect admin.css for consistent variables -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            color: #f8fafc;
            padding: 24px;
            position: relative;
        }

        /* Abstract decorative shapes in background */
        body::before {
            content: '';
            position: absolute;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, rgba(0,0,0,0) 70%);
            top: -10%;
            left: -10%;
            z-index: 1;
            border-radius: 50%;
        }
        body::after {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, rgba(0,0,0,0) 75%);
            bottom: -20%;
            right: -10%;
            z-index: 1;
            border-radius: 50%;
        }

        .container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1050px;
            text-align: center;
        }

        /* Header / Logo section */
        .header {
            margin-bottom: 50px;
            animation: fadeInDown 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        .logo-icon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            width: 70px;
            height: 70px;
            border-radius: 20px;
            font-size: 2.2rem;
            color: white;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.35);
            margin-bottom: 24px;
            transform: rotate(-5deg);
            transition: all 0.3s ease;
        }
        .logo-icon:hover {
            transform: rotate(0deg) scale(1.1);
        }
        .header h1 {
            font-size: 3.2rem;
            font-weight: 800;
            letter-spacing: -1px;
            background: linear-gradient(to right, #ffffff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 12px;
        }
        .header p {
            font-size: 1.15rem;
            color: #94a3b8;
            max-width: 620px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Dual card layout */
        .cards-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            margin-bottom: 50px;
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.2s both;
        }

        .card {
            background: rgba(30, 41, 59, 0.45);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 32px;
            padding: 45px 35px;
            text-align: left;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(180deg, rgba(255,255,255,0.03) 0%, rgba(0,0,0,0) 100%);
            pointer-events: none;
        }
        .card:hover {
            transform: translateY(-8px);
            border-color: rgba(59, 130, 246, 0.4);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 0 30px rgba(59, 130, 246, 0.1);
        }

        .card-icon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 60px;
            height: 60px;
            border-radius: 18px;
            font-size: 1.8rem;
            margin-bottom: 28px;
            transition: all 0.3s ease;
        }
        .catalog-card .card-icon {
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }
        .admin-card .card-icon {
            background: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
        }
        .card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .card h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: white;
        }
        .card p {
            font-size: 0.95rem;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .card-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 28px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            width: fit-content;
        }
        .catalog-card .card-btn {
            background: #10b981;
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
        }
        .catalog-card .card-btn:hover {
            background: #059669;
            box-shadow: 0 10px 24px rgba(16, 185, 129, 0.4);
            transform: translateX(4px);
        }
        .admin-card .card-btn {
            background: #3b82f6;
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.25);
        }
        .admin-card .card-btn:hover {
            background: #2563eb;
            box-shadow: 0 10px 24px rgba(59, 130, 246, 0.4);
            transform: translateX(4px);
        }

        /* Footer info */
        .footer {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 20px;
            animation: fadeIn 1s ease 0.4s both;
        }
        .footer a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer a:hover {
            color: #3b82f6;
        }

        /* Animations definitions */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media (max-width: 768px) {
            .cards-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .header h1 {
                font-size: 2.3rem;
            }
            .logo-icon {
                width: 60px;
                height: 60px;
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- HEADER -->
        <header class="header">
            <div class="logo-icon"><i class="fas fa-tools"></i></div>
            <h1>Inventory & Lending</h1>
            <p>Sistema inteligente para el control y préstamo de herramientas de trabajo. Optimiza la gestión de inventario y solicita equipos de forma rápida e intuitiva.</p>
        </header>

        <!-- CARDS -->
        <main class="cards-row">
            <!-- CATALOG CARD -->
            <section class="card catalog-card">
                <div>
                    <div class="card-icon"><i class="fas fa-search"></i></div>
                    <h2>Catálogo de Herramientas</h2>
                    <p>Explora la lista completa de herramientas disponibles en el inventario. Consulta categorías, verifica disponibilidad en tiempo real y solicita préstamos de manera digital con solo llenar un formulario.</p>
                </div>
                <a href="{{ route('compartidas.lista') }}" class="card-btn">
                    <span>Ver Catálogo</span> <i class="fas fa-arrow-right"></i>
                </a>
            </section>

            <!-- ADMIN CARD -->
            <section class="card admin-card">
                <div>
                    <div class="card-icon"><i class="fas fa-user-shield"></i></div>
                    <h2>Panel de Administración</h2>
                    <p>Acceso exclusivo para administradores y encargados de bodega. Gestiona el registro del inventario (altas, bajas y modificaciones), controla los préstamos activos y visualiza el historial de devoluciones.</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="card-btn">
                    <span>Acceder Panel</span> <i class="fas fa-arrow-right"></i>
                </a>
            </section>
        </main>

        <!-- FOOTER -->
        <footer class="footer">
            <p>© 2026 Inventory & Lending System. Diseñado con altos estándares estéticos y de usabilidad.</p>
        </footer>
    </div>

</body>
</html>