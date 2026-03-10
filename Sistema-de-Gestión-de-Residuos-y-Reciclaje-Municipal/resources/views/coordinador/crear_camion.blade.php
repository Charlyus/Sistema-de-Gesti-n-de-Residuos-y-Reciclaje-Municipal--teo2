<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Nuevo Camión</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Registrar Camión</h3>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<form method="POST" action="/camiones/guardar">

@csrf

<div class="mb-3">
<label>Placa</label>
<input type="text" name="placa" class="form-control" required>
</div>

<div class="mb-3">
<label>Capacidad (Toneladas)</label>
<input type="number" step="0.01" name="capacidad" class="form-control" required>
</div>

<div class="mb-3">
<label>Estado</label>

<select name="estado" class="form-control">

<option value="Operativo">Operativo</option>
<option value="Mantenimiento">Mantenimiento</option>
<option value="Fuera de servicio">Fuera de servicio</option>

</select>

</div>

<div class="mb-3">
<label>Conductor</label>

<select name="conductor" class="form-control">

@foreach($conductores as $c)

<option value="{{ $c->id_usuario }}">
{{ $c->nombre }}
</option>

@endforeach

</select>

</div>

<button class="btn btn-success">
Guardar Camión
</button>

<a href="/coordinador/dashboard" class="btn btn-secondary">
Volver
</a>

</form>

</div>

</body>
</html>