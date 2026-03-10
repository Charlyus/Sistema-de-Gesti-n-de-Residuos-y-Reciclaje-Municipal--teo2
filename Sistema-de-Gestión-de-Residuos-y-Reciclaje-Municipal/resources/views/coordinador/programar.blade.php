<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<title>Programar Recolección</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.card{
border:none;
border-radius:12px;
}

.card-header{
font-weight:bold;
font-size:18px;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-7">

<div class="card shadow-lg">

<div class="card-header bg-primary text-white">

🚛 Asignar Camión a Ruta

</div>

<div class="card-body">
@if(session('error'))

<div class="alert alert-danger">
{{ session('error') }}
</div>

@endif

<form method="POST" action="/recolecciones/guardar">

@csrf

<div class="mb-3">

<label class="form-label fw-bold">
Ruta
</label>

<select name="id_ruta" class="form-select">

@foreach($rutas as $ruta)

<option value="{{ $ruta->id_ruta }}">
{{ $ruta->nombre_identificador }}
</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label class="form-label fw-bold">
Camión
</label>

<select name="id_camion" class="form-select">

@foreach($camiones as $camion)

<option value="{{ $camion->id_camion }}">
{{ $camion->placa }}
</option>

@endforeach

</select>

</div>

<div class="mb-4">

<label class="form-label fw-bold">
Fecha de Recolección
</label>

<input type="date" name="fecha_programada" class="form-control">

</div>

<div class="d-flex justify-content-between">

<a href="/coordinador/dashboard" class="btn btn-secondary">
⬅ Volver
</a>

<button class="btn btn-success">
✔ Programar Recolección
</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>