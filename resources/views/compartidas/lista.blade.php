<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory & Lending</title>
</head>
<body>
    <div class="content">
      <div class="list-card">
        <div class="list-header">
          <span class="list-title">Lista de herramientas</span>
          <div style="display:flex;gap:8px;align-items:center;">
            <span id="filter-all" style="cursor:pointer;font-size:12px;color:var(--blue);font-weight:500;" onclick="setFilter('all')">Todas</span>
            <span style="color:var(--text3)">·</span>
            <span style="cursor:pointer;font-size:12px;color:var(--text2);" onclick="setFilter('disponible')">Disponibles</span>
            <span style="color:var(--text3)">·</span>
            <span style="cursor:pointer;font-size:12px;color:var(--text2);" onclick="setFilter('prestado')">En préstamo</span>
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
              <th style="width:130px;"></th>
            </tr>
          </thead>
          <tbody id="tools-body"></tbody>
        </table>
      </div>
    </div>


    <!-- formulario de préstamo flotante -->
    <div class="view" id="view-prestamo-form">
      <div class="form-wrap">
        <div class="form-title">Solicitar préstamo</div>
        <div class="form-sub">Completa los datos para reservar una herramienta</div>

        <div id="prev-box"></div>

        <div class="field">
          <label>Herramienta</label>
          <select id="f-tool" onchange="updPrev()"><option value="">— Seleccionar —</option></select>
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
            <option>1 día</option><option>3 días</option>
            <option>1 semana</option><option>2 semanas</option><option>1 mes</option>
          </select>
        </div>
        <div class="field">
          <label>Motivo / proyecto</label>
          <textarea id="f-motivo" placeholder="Describe brevemente el uso..."></textarea>
        </div>
        <div class="form-actions">
          <button class="btn btn-outline" onclick="go('herramientas')">Cancelar</button>
          <button class="btn btn-primary" onclick="submitPrestamo()"><i class="ti ti-send"></i> Confirmar</button>
        </div>
      </div>
    </div>
</body>
</html>