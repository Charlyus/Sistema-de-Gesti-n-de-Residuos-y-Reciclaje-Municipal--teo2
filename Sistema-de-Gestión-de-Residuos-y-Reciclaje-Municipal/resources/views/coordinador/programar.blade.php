<!DOCTYPE html>
<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h3>Programar Recolección</h3>

<form method="POST" action="/coordinador/programar">

@csrf

<div class="mb-3">
<label class="form-label">Ruta</label>

<select name="id_ruta" class="form-control">

@foreach($rutas as $ruta)

<option value="{{ $ruta->id_ruta }}">
{{ $ruta->nombre_identificador }}
</option>

@endforeach

</select>
</div>


<div class="mb-3">
<label class="form-label">Camión</label>

<select name="id_camion" class="form-control">

@foreach($camiones as $camion)

<option value="{{ $camion->id_camion }}">
{{ $camion->placa }}
</option>

@endforeach

</select>
</div>


<div class="mb-3">

<label class="form-label">Fecha Programada</label>

<input type="date" name="fecha_programada" class="form-control">

</div>


<button class="btn btn-success">

Programar Recolección

</button>

<a href="/coordinador/dashboard" class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

</body>
</html>