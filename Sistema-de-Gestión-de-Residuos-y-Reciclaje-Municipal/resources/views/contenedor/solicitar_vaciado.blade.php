<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Solicitar Vaciado</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Solicitar Vaciado de Contenedor</h3>

<form method="POST" action="/contenedor/programar-vaciado">

@csrf

<div class="mb-3">

<label>Contenedor</label>

<select name="id_contenedor" class="form-control">

@foreach($contenedores as $c)

<option value="{{$c->id_contenedor}}">

Contenedor {{$c->id_contenedor}}  
({{$c->cantidad_actual_kg}} / {{$c->capacidad_kg}} kg)

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Recolector asignado</label>

<select name="id_recolector" class="form-control">

@foreach($recolectores as $r)

<option value="{{$r->id_usuario}}">
{{$r->nombre}}
</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Fecha programada</label>

<input type="datetime-local" name="fecha_programada" class="form-control" required>

</div>



<button class="btn btn-danger">
Programar vaciado
</button>

<a href="/punto-verde/dashboard" class="btn btn-secondary">
Cancelar
</a>

</form>

</div>

</body>

</html>