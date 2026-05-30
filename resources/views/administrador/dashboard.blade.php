<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Admin Dashboard | Herramientas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="sidebar">
    <div class="logo-area">
        <h2><i class="fas fa-tools"></i> <span>Inventory & Lending</span></h2>
    </div>
    <div class="nav-menu">
        <div class="nav-item active" data-view="admin-dash"><i class="fas fa-chart-line"></i> <span>Dashboard</span></div>
        <div class="nav-item" data-view="admin-prestamos"><i class="fas fa-hand-holding-usd"></i> <span>Préstamos</span></div>
        <div class="nav-item" data-view="admin-crud"><i class="fas fa-database"></i> <span>Herramientas</span></div>
    </div>
</div>

<div class="main-content">
    <!-- ====== ADMIN DASH ====== -->
    <div class="view active-view" id="view-admin-dash">
        <div class="stats-row">
            <div class="stat-card"><div class="stat-label">Préstamos activos</div><div class="stat-value" style="color:var(--blue)">3</div><div class="stat-sub">en circulación</div></div>
            <div class="stat-card"><div class="stat-label">Vencen esta semana</div><div class="stat-value" style="color:var(--amber)">2</div><div class="stat-sub">próximas devoluciones</div></div>
            <div class="stat-card"><div class="stat-label">Total herramientas</div><div class="stat-value" id="total-herramientas-stat">12</div><div class="stat-sub">en inventario</div></div>
            <div class="stat-card"><div class="stat-label">Préstamos este mes</div><div class="stat-value" style="color:var(--green)">17</div><div class="stat-sub">completados</div></div>
        </div>
        <div class="two-col">
            <div class="list-card">
                <div class="list-header"><span class="list-title">Préstamos activos</span><span class="badge badge-amber" id="activos-count-badge">3</span></div>
                <table>
                    <thead><tr><th>Herramienta</th><th>Empleado</th><th>Vence</th></tr></thead>
                    <tbody id="da-activos"></tbody>
                </table>
            </div>
            <div class="list-card">
                <div class="list-header"><span class="list-title">Disponibles</span><span class="badge badge-green" id="disponibles-count-badge">8</span></div>
                <table><thead><tr><th>Herramienta</th><th>Código</th></tr></thead><tbody id="da-disp"></tbody></table>
            </div>
        </div>
    </div>

    <!-- ====== ADMIN PRÉSTAMOS ====== -->
    <div class="view" id="view-admin-prestamos">
        <div class="section-hdr"><span class="section-ttl">Gestión de préstamos</span></div>
        <div class="tab-row">
            <button class="tab active" data-filtro="all">Todos</button>
            <button class="tab" data-filtro="activo">Activos</button>
            <button class="tab" data-filtro="devuelto">Devueltos</button>
        </div>
        <div class="list-card">
            <table>
                <thead><tr><th>Empleado</th><th>Carnet</th><th>Herramienta</th><th>Inicio</th><th>Vence</th><th>Estado</th><th></th></tr></thead>
                <tbody id="ap-body"></tbody>
            </table>
        </div>
    </div>

    <!-- ====== ADMIN CRUD ====== -->
    <div class="view" id="view-admin-crud">
        <div class="section-hdr">
            <span class="section-ttl">CRUD de herramientas</span>
            <button class="btn btn-primary btn-sm" id="open-add-modal"><i class="fas fa-plus"></i> Agregar</button>
        </div>
        <div class="list-card">
            <table>
                <thead><tr><th style="width:100px;">Código</th><th>Nombre</th><th>Categoría</th><th>Estado</th><th>Titular</th><th style="width:130px;"></th></tr></thead>
                <tbody id="crud-body"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL AGREGAR/EDITAR HERRAMIENTA -->
<div id="toolModal" class="modal">
    <div class="modal-card">
        <h3 id="modal-title">Agregar herramienta</h3>
        <input type="hidden" id="edit-id">
        <div class="form-group"><label>Código</label><input type="text" id="tool-code" placeholder="Ej: H-101"></div>
        <div class="form-group"><label>Nombre</label><input type="text" id="tool-name" placeholder="Taladro"></div>
        <div class="form-group"><label>Categoría</label><input type="text" id="tool-cat" placeholder="Eléctrica"></div>
        <div class="form-group"><label>Estado</label>
            <select id="tool-state"><option value="Disponible">Disponible</option><option value="Prestado">Prestado</option><option value="Mantenimiento">Mantenimiento</option></select>
        </div>
        <div class="form-group"><label>Titular (Opcional)</label><input type="text" id="tool-titular" placeholder="Responsable"></div>
        <div class="modal-buttons">
            <button class="btn btn-outline" id="close-modal">Cancelar</button>
            <button class="btn btn-primary" id="save-tool-btn">Guardar</button>
        </div>
    </div>
</div>

<script>
    // ======================== DATOS DE EJEMPLO ==========================
    // Herramientas
    let herramientas = [
        { id: 1, codigo: "H-001", nombre: "Taladro percutor", categoria: "Eléctrica", estado: "Disponible", titular: "Bodega" },
        { id: 2, codigo: "H-002", nombre: "Sierra circular", categoria: "Eléctrica", estado: "Prestado", titular: "Carlos Ruiz" },
        { id: 3, codigo: "H-003", nombre: "Llave de impacto", categoria: "Neumática", estado: "Disponible", titular: "Bodega" },
        { id: 4, codigo: "H-004", nombre: "Amoladora angular", categoria: "Eléctrica", estado: "Prestado", titular: "Laura Gómez" },
        { id: 5, codigo: "H-005", nombre: "Cinta métrica láser", categoria: "Medición", estado: "Disponible", titular: "Bodega" },
        { id: 6, codigo: "H-006", nombre: "Compresor 50L", categoria: "Neumática", estado: "Mantenimiento", titular: "Taller" },
        { id: 7, codigo: "H-007", nombre: "Atornillador eléctrico", categoria: "Eléctrica", estado: "Disponible", titular: "Bodega" },
        { id: 8, codigo: "H-008", nombre: "Nivel láser", categoria: "Medición", estado: "Disponible", titular: "Bodega" },
        { id: 9, codigo: "H-009", nombre: "Hidrolavadora", categoria: "Limpieza", estado: "Disponible", titular: "Bodega" },
        { id: 10, codigo: "H-010", nombre: "Martillo demoledor", categoria: "Eléctrica", estado: "Prestado", titular: "Jorge Méndez" }
    ];

    // Préstamos (incluye algunos devueltos y activos)
    let prestamos = [
        { id: 1, empleado: "Carlos Ruiz", carnet: "CR001", herramientaId: 2, herramientaNombre: "Sierra circular", inicio: "2025-05-10", vence: "2025-06-07", estado: "activo" },
        { id: 2, empleado: "Laura Gómez", carnet: "LG002", herramientaId: 4, herramientaNombre: "Amoladora angular", inicio: "2025-05-12", vence: "2025-06-09", estado: "activo" },
        { id: 3, empleado: "Jorge Méndez", carnet: "JM003", herramientaId: 10, herramientaNombre: "Martillo demoledor", inicio: "2025-05-18", vence: "2025-06-15", estado: "activo" },
        { id: 4, empleado: "Ana Pereira", carnet: "AP004", herramientaId: 7, herramientaNombre: "Atornillador eléctrico", inicio: "2025-04-01", vence: "2025-04-28", estado: "devuelto" },
        { id: 5, empleado: "Roberto Díaz", carnet: "RD005", herramientaId: 5, herramientaNombre: "Cinta métrica láser", inicio: "2025-05-01", vence: "2025-05-28", estado: "devuelto" }
    ];

    let nextToolId = 11;

    // Helper: obtener herramientas disponibles (estado === "Disponible")
    function getAvailableTools() {
        return herramientas.filter(h => h.estado === "Disponible");
    }

    // Helper: obtener prestamos activos
    function getActiveLoans() {
        return prestamos.filter(p => p.estado === "activo");
    }

    // Renderizar Dashboard (estadisticas, listas activas, disponibles)
    function renderDashboard() {
        const activos = getActiveLoans();
        const disponiblesArr = getAvailableTools();
        const totalHerramientas = herramientas.length;

        document.getElementById("total-herramientas-stat").innerText = totalHerramientas;
        document.getElementById("activos-count-badge").innerText = activos.length;
        document.getElementById("disponibles-count-badge").innerText = disponiblesArr.length;

        const tbodyActivos = document.getElementById("da-activos");
        tbodyActivos.innerHTML = activos.map(loan => {
            const venceDate = new Date(loan.vence);
            const hoy = new Date();
            const diffDays = Math.ceil((venceDate - hoy) / (1000*60*60*24));
            const warning = diffDays <= 3 && diffDays >= 0 ? '⚠️' : '';
            return `<tr><td>${loan.herramientaNombre}</td><td>${loan.empleado}</td><td>${loan.vence} ${warning}</td></tr>`;
        }).join("");
        if(activos.length===0) tbodyActivos.innerHTML = '<tr><td colspan="3">Sin préstamos activos</td></tr>';

        const tbodyDisp = document.getElementById("da-disp");
        tbodyDisp.innerHTML = disponiblesArr.slice(0,5).map(h => `<tr><td>${h.nombre}</td><td>${h.codigo}</td></tr>`).join("");
        if(disponiblesArr.length===0) tbodyDisp.innerHTML = '<tr><td colspan="2">No hay disponibles</td></tr>';
    }

    // Renderizar tabla de prestamos (con filtro)
    let currentFilter = "all";
    function renderPrestamosTable() {
        let filtered = prestamos.slice();
        if(currentFilter === "activo") filtered = filtered.filter(p => p.estado === "activo");
        if(currentFilter === "devuelto") filtered = filtered.filter(p => p.estado === "devuelto");

        const tbody = document.getElementById("ap-body");
        tbody.innerHTML = filtered.map(p => {
            let estadoHtml = p.estado === "activo" ? '<span class="estado-badge activo-badge"><i class="fas fa-hourglass-half"></i> Activo</span>' : '<span class="estado-badge devuelto-badge"><i class="fas fa-check-circle"></i> Devuelto</span>';
            let acciones = p.estado === "activo" ? `<button class="btn btn-sm btn-outline" onclick="devolverPrestamo(${p.id})">Devolver</button>` : `—`;
            return `<tr><td>${p.empleado}</td><td>${p.carnet}</td><td>${p.herramientaNombre}</td><td>${p.inicio}</td><td>${p.vence}</td><td>${estadoHtml}</td><td>${acciones}</td></tr>`;
        }).join("");
        if(filtered.length===0) tbody.innerHTML = '<tr><td colspan="7">No hay préstamos con este filtro</td></tr>';
    }

    // Devolver préstamo
    window.devolverPrestamo = function(prestamoId) {
        const prestamo = prestamos.find(p => p.id === prestamoId);
        if(prestamo && prestamo.estado === "activo") {
            prestamo.estado = "devuelto";
            // actualizar herramienta relacionada a disponible si estaba prestada
            const herramienta = herramientas.find(h => h.nombre === prestamo.herramientaNombre);
            if(herramienta && herramienta.estado === "Prestado") {
                herramienta.estado = "Disponible";
                herramienta.titular = "Bodega";
            }
            renderDashboard();
            renderPrestamosTable();
            renderCrudTable();
        }
    }

    // CRUD render
    function renderCrudTable() {
        const tbody = document.getElementById("crud-body");
        tbody.innerHTML = herramientas.map(h => `
            <tr>
                <td>${h.codigo}</td><td>${h.nombre}</td><td>${h.categoria}</td>
                <td><span class="estado-badge" style="background:#f1f5f9;">${h.estado}</span></td>
                <td>${h.titular || '—'}</td>
                <td class="action-icons">
                    <i class="fas fa-edit" style="color:#2563eb" onclick="editarHerramienta(${h.id})" title="Editar"></i>
                    <i class="fas fa-trash-alt" style="color:#ef4444" onclick="eliminarHerramienta(${h.id})" title="Eliminar"></i>
                </td>
            </tr>
        `).join("");
    }

    // CRUD funciones globales
    window.openAdd = function() {
        document.getElementById("modal-title").innerText = "Agregar herramienta";
        document.getElementById("edit-id").value = "";
        document.getElementById("tool-code").value = "";
        document.getElementById("tool-name").value = "";
        document.getElementById("tool-cat").value = "";
        document.getElementById("tool-state").value = "Disponible";
        document.getElementById("tool-titular").value = "";
        document.getElementById("toolModal").style.display = "flex";
    }

    window.editarHerramienta = function(id) {
        const tool = herramientas.find(h => h.id === id);
        if(tool) {
            document.getElementById("modal-title").innerText = "Editar herramienta";
            document.getElementById("edit-id").value = tool.id;
            document.getElementById("tool-code").value = tool.codigo;
            document.getElementById("tool-name").value = tool.nombre;
            document.getElementById("tool-cat").value = tool.categoria;
            document.getElementById("tool-state").value = tool.estado;
            document.getElementById("tool-titular").value = tool.titular || "";
            document.getElementById("toolModal").style.display = "flex";
        }
    }

    window.eliminarHerramienta = function(id) {
        if(confirm("¿Eliminar herramienta permanentemente? Se perderán asociaciones")) {
            // Verificar si tiene préstamos activos asociados (por nombre)
            const tool = herramientas.find(h => h.id === id);
            if(tool) {
                const tienePrestamoActivo = prestamos.some(p => p.herramientaNombre === tool.nombre && p.estado === "activo");
                if(tienePrestamoActivo) {
                    alert("No se puede eliminar: la herramienta tiene un préstamo activo.");
                    return;
                }
                herramientas = herramientas.filter(h => h.id !== id);
                renderDashboard();
                renderCrudTable();
                renderPrestamosTable();
            }
        }
    }

    function guardarHerramienta() {
        const id = document.getElementById("edit-id").value;
        const codigo = document.getElementById("tool-code").value.trim();
        const nombre = document.getElementById("tool-name").value.trim();
        const categoria = document.getElementById("tool-cat").value.trim();
        const estado = document.getElementById("tool-state").value;
        const titular = document.getElementById("tool-titular").value.trim() || "Bodega";

        if(!codigo || !nombre) { alert("Código y nombre son obligatorios"); return; }

        if(id) { // editar
            const idx = herramientas.findIndex(h => h.id == id);
            if(idx !== -1) {
                herramientas[idx] = { ...herramientas[idx], codigo, nombre, categoria, estado, titular };
            }
        } else { // crear
            const newId = nextToolId++;
            herramientas.push({ id: newId, codigo, nombre, categoria, estado, titular });
        }
        document.getElementById("toolModal").style.display = "none";
        renderDashboard();
        renderCrudTable();
        renderPrestamosTable(); // actualiza si cambio el estado de herramienta
    }

    // inicializar eventos navegación y filtros
    function setupNavigation() {
        const navs = document.querySelectorAll(".nav-item");
        const views = document.querySelectorAll(".view");
        navs.forEach(nav => {
            nav.addEventListener("click", () => {
                const viewId = nav.getAttribute("data-view");
                navs.forEach(n => n.classList.remove("active"));
                nav.classList.add("active");
                views.forEach(v => v.classList.remove("active-view"));
                document.getElementById(`view-${viewId}`).classList.add("active-view");
                if(viewId === "admin-dash") renderDashboard();
                if(viewId === "admin-prestamos") renderPrestamosTable();
                if(viewId === "admin-crud") renderCrudTable();
            });
        });
    }

    function setupFilters() {
        const filtroBtns = document.querySelectorAll("#view-admin-prestamos .tab");
        filtroBtns.forEach(btn => {
            btn.addEventListener("click", (e) => {
                filtroBtns.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                const filtro = btn.getAttribute("data-filtro");
                currentFilter = filtro;
                renderPrestamosTable();
            });
        });
    }

    function setupModal() {
        const modal = document.getElementById("toolModal");
        document.getElementById("open-add-modal").addEventListener("click", openAdd);
        document.getElementById("close-modal").addEventListener("click", () => modal.style.display = "none");
        document.getElementById("save-tool-btn").addEventListener("click", guardarHerramienta);
        window.onclick = (e) => { if(e.target === modal) modal.style.display = "none"; };
    }

    // inicialización total
    function init() {
        setupNavigation();
        setupFilters();
        setupModal();
        renderDashboard();
        renderPrestamosTable();
        renderCrudTable();
    }
    init();
</script>
</body>
</html>