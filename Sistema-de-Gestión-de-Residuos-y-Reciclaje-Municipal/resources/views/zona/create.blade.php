<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Nueva Zona</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Crear nueva zona</h3>

<form method="POST" action="/zona/store">

@csrf

<div class="mb-3">

<label class="form-label">Nombre de la zona</label>

<input type="text" name="nombre" class="form-control" required>

</div>

<div class="mb-3">

<label class="form-label">Densidad poblacional</label>

<select name="densidad_poblacional" class="form-control" required>

<option value="Residencial">Residencial</option>

<option value="Comercial">Comercial</option>

<option value="Industrial">Industrial</option>

</select>

</div>

<button class="btn btn-success">
Guardar zona
</button>

<a href="/coordinador/dashboard" class="btn btn-secondary">
Cancelar
</a>

</form>

</div>

</body>
</html>