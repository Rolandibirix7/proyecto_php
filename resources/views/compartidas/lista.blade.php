<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Herramientas | Inventory & Lending</title>
    <!-- Add FontAwesome for premium icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Connect connected CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .form-wrap {
            max-width: 550px;
            margin: 40px auto;
            background: var(--card-white);
            padding: 30px;
            border-radius: 24px;
            border: 1px solid var(--border-light);
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        }
        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 6px;
        }
        .form-sub {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 24px;
        }
        .divider {
            border: 0;
            border-top: 1px solid var(--border-light);
            margin: 20px 0;
        }
        .field {
            margin-bottom: 16px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .field label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .field input, .field select, .field textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: 14px;
            border: 1px solid var(--border-light);
            font-family: inherit;
            font-size: 0.9rem;
            background: var(--gray-light);
            transition: all 0.2s ease;
        }
        .field input:focus, .field select:focus, .field textarea:focus {
            outline: none;
            border-color: var(--blue);
            background: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }
        /* Style adjustments for SPA style listing */
        .list-header {
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 16px;
            margin-bottom: 20px;
        }
        /* SEARCH */
    .search-wrap {
      position: relative;
    }

    .search-wrap i {
      position: absolute;
      left: 9px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text3);
      font-size: 15px;
      pointer-events: none;
    }
    
    .topbar {
      height: 54px;
      background: var(--white);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 24px;
      position: sticky;
      top: 0;
      z-index: 50;
    }

    .topbar-title {
      font-size: 15px;
      font-weight: 600;
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .search-wrap input {
      background: var(--bg);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      font-family: 'Inter', sans-serif;
      font-size: 13px;
      padding: 7px 10px 7px 30px;
      outline: none;
      width: 220px;
      color: var(--text);
    }

    .search-wrap input:focus {
      border-color: var(--blue);
    }

    
    </style>
</head>
<body>
    <!-- SIDEBAR DE NAVEGACIÓN -->
    <div class="sidebar">
        <div class="logo-area">
            <h2><i class="fas fa-tools"></i> <span>Inventory & Lending</span></h2>
        </div>
        <div class="nav-menu">
            <a href="{{ url('/') }}" class="nav-item" style="text-decoration:none;"><i class="fas fa-home"></i> <span>Inicio</span></a>
            <div class="nav-item active"><i class="fas fa-list"></i> <span>Catálogo</span></div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item" style="text-decoration:none;"><i class="fas fa-user-shield"></i> <span>Administración</span></a>
        </div>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
     <!-- Busqueda -->
     <div class="topbar">
      <span class="topbar-title" id="ttl">Herramientas</span>
      <div class="topbar-right">
        <div class="search-wrap" id="search-wrap">
          <i class="ti ti-search"></i>
          <input type="text" placeholder="Buscar..." id="q" oninput="filterTools()">
        </div>
        <button class="btn btn-ghost" style="padding:7px;"><i class="ti ti-bell" style="font-size:17px;"></i></button>
      </div>
    </div>


    <!-- VISTA DEL LISTADO -->
    <div class="main-content">
        <div class="view active-view" id="view-herramientas">
            <div class="list-card">
                <div class="list-header">
                    <span class="list-title">Lista de herramientas</span>
                    <div style="display:flex;gap:12px;align-items:center;">
                        <span id="filter-all" class="badge badge-blue" style="cursor:pointer;" onclick="setFilter('all')">Todas</span>
                        <span id="filter-disponible" class="badge" style="cursor:pointer;background:#f1f5f9;color:var(--text-muted);" onclick="setFilter('disponible')">Disponibles</span>
                        <span id="filter-prestado" class="badge" style="cursor:pointer;background:#f1f5f9;color:var(--text-muted);" onclick="setFilter('prestado')">En préstamo</span>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th style="width:110px;">Código</th>
                            <th>Herramienta</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th>Titular actual</th>
                            <th style="width:150px; text-align:right;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tools-body">
                        <!-- Cargar dinámicamente -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- FORMULARIO DE PRÉSTAMO FLOTANTE -->
        <div class="view" id="view-prestamo-form">
            <div class="form-wrap">
                <div class="form-title">Solicitar préstamo</div>
                <div class="form-sub">Completa los datos para reservar una herramienta</div>

                <div id="prev-box"></div>

                <div class="field">
                    <label>Herramienta seleccionada</label>
                    <select id="f-tool" onchange="updPrev()" disabled>
                        <option value="">— Seleccionar —</option>
                    </select>
                </div>
                <hr class="divider">
                <div class="field-row">
                    <div class="field" style="margin:0">
                        <label>Carnet / ID</label>
                        <input type="text" placeholder="EMP-0031" id="f-carnet">
                    </div>
                    <div class="field" style="margin:0">
                        <label>Nombre completo</label>
                        <input type="text" placeholder="Tu nombre" id="f-nombre">
                    </div>
                </div>
                <div class="field-row" style="margin-top:14px;">
                    <div class="field" style="margin:0">
                        <label>Fecha de préstamo</label>
                        <input type="date" id="f-inicio">
                    </div>
                    <div class="field" style="margin:0">
                        <label>Fecha de devolución</label>
                        <input type="date" id="f-fin">
                    </div>
                </div>
                <div class="field" style="margin-top:14px;">
                    <label>Plazo</label>
                    <select id="f-plazo">
                        <option value="">Seleccionar...</option>
                        <option value="1 día">1 día</option>
                        <option value="3 días">3 días</option>
                        <option value="1 semana">1 semana</option>
                        <option value="2 semanas">2 semanas</option>
                        <option value="1 mes">1 mes</option>
                    </select>
                </div>
                <div class="field">
                    <label>Motivo / proyecto</label>
                    <textarea id="f-motivo" rows="3" placeholder="Describe brevemente el uso..."></textarea>
                </div>
                <div class="form-actions">
                    <button class="btn btn-outline" onclick="go('herramientas')">Cancelar</button>
                    <button class="btn btn-primary" onclick="submitPrestamo()"><i class="fas fa-paper-plane"></i> Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- INTERACTIVIDAD MOCK -->
    <script>
        // Datos de herramientas reales cargados desde la base de datos
        let herramientas = @json($herramientas);

        let filter = 'all';

        // Cambiar vista SPA
        function go(viewId) {
            document.querySelectorAll('.view').forEach(v => v.classList.remove('active-view'));
            document.getElementById(`view-${viewId}`).classList.add('active-view');
        }

        // Renderizar tabla
        function renderTools() {
            const tbody = document.getElementById('tools-body');
            let filtered = herramientas;

            if (filter === 'disponible') {
                filtered = herramientas.filter(h => h.estado === 'disponible');
            } else if (filter === 'prestado') {
                filtered = herramientas.filter(h => h.estado === 'prestado');
            }

            tbody.innerHTML = filtered.map(h => {
                let badgeClass = 'badge-green';
                let labelEstado = 'Disponible';
                if (h.estado === 'prestado') {
                    badgeClass = 'badge-amber';
                    labelEstado = 'En préstamo';
                } else if (h.estado === 'mantenimiento') {
                    badgeClass = 'badge-blue';
                    labelEstado = 'Mantenimiento';
                }

                let btnHtml = '';
                if (h.estado === 'disponible') {
                    btnHtml = `<button class="btn btn-primary btn-sm" onclick="solicitarPrestamo(${h.id})"><i class="fas fa-hand-holding"></i> Solicitar</button>`;
                } else {
                    btnHtml = `<button class="btn btn-outline btn-sm" disabled style="opacity:0.6; cursor:not-allowed;">No disponible</button>`;
                }

                return `
                    <tr>
                        <td><strong>${h.codigo}</strong></td>
                        <td>${h.nombre}</td>
                        <td>${h.categoria}</td>
                        <td><span class="estado-badge ${badgeClass}">${labelEstado}</span></td>
                        <td>${h.titular}</td>
                        <td style="text-align:right;">${btnHtml}</td>
                    </tr>
                `;
            }).join('');
        }

        // Establecer filtro
        window.setFilter = function(f) {
            filter = f;
            document.querySelectorAll('.list-header span.badge').forEach(b => {
                b.style.background = '#f1f5f9';
                b.style.color = 'var(--text-muted)';
                b.className = 'badge';
            });

            const activeBtn = document.getElementById(`filter-${f}`);
            activeBtn.className = 'badge badge-blue';
            renderTools();
        }

        // Abrir formulario de solicitud
        window.solicitarPrestamo = function(toolId) {
            const tool = herramientas.find(h => h.id === toolId);
            if (!tool) return;

            // Llenar select
            const select = document.getElementById('f-tool');
            select.innerHTML = `<option value="${tool.id}">${tool.codigo} - ${tool.nombre}</option>`;
            select.value = tool.id;

            // Fechas por defecto
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('f-inicio').value = today;
            
            const nextWeek = new Date();
            nextWeek.setDate(nextWeek.getDate() + 7);
            document.getElementById('f-fin').value = nextWeek.toISOString().split('T')[0];
            document.getElementById('f-plazo').value = '1 semana';

            go('prestamo-form');
        }

        // Registrar solicitud
        window.submitPrestamo = function() {
            const carnet = document.getElementById('f-carnet').value.trim();
            const nombre = document.getElementById('f-nombre').value.trim();
            const motivo = document.getElementById('f-motivo').value.trim();
            const select = document.getElementById('f-tool');
            const toolId = parseInt(select.value);

            if (!carnet || !nombre) {
                alert('Por favor ingresa tu carnet y nombre completo.');
                return;
            }

            const tool = herramientas.find(h => h.id === toolId);
            if (tool) {
                tool.estado = 'prestado';
                tool.titular = nombre;
                alert(`¡Préstamo solicitado exitosamente para ${tool.nombre}!`);
                
                // Limpiar campos
                document.getElementById('f-carnet').value = '';
                document.getElementById('f-nombre').value = '';
                document.getElementById('f-motivo').value = '';
                
                go('herramientas');
                renderTools();
            }
        }

        // Inicializar
        renderTools();
    </script>
</body>
</html>