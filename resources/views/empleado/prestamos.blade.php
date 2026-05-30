<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory & Lending</title>
</head>
<body>
    <div class="view" id="view-mis-prestamos">
      <div class="section-hdr">
        <span class="section-ttl">Préstamos activos</span>
        <button class="btn btn-primary btn-sm" onclick="go('prestamo-form')"><i class="ti ti-plus"></i> Nuevo</button>
      </div>
      <div id="mp-activos"></div>

      <div style="margin-top:24px;">
        <div class="section-hdr">
          <span class="section-ttl" style="color:var(--text2);font-size:13px;">Historial</span>
        </div>
        <div class="list-card">
          <table>
            <thead><tr><th>Herramienta</th><th>Inicio</th><th>Devolución</th><th>Estado</th></tr></thead>
            <tbody id="mp-hist"></tbody>
          </table>
        </div>
      </div>
    </div>
</body>
</html>