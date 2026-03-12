<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Registrar Contenedor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Registrar Contenedor</h3>

<form method="POST" action="/contenedor/store">

@csrf


<div class="d-flex justify-content-end">
    <a href="/contenedor/list" class="btn btn-success">ver contenedores</a>
</div>

<div class="mb-3">

<label>Punto Verde</label>

<select name="id_punto_verde" class="form-control">

@foreach($puntos as $p)

<option value="{{$p->id_punto_verde}}">
{{$p->nombre}}
</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Tipo de Material</label>

<select name="id_tipo_material" class="form-control">

@foreach($materiales as $m)

<option value="{{$m->id_tipo_material}}">
{{$m->nombre}}
</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Porcentaje de llenado</label>

<input type="number" name="porcentaje_llenado" class="form-control" min="0" max="100" value="0">

</div>

<div class="mb-3">

<label>Última limpieza</label>

<input type="datetime-local" name="ultima_limpieza" class="form-control">

</div>

<button class="btn btn-success">
Guardar
</button>

<a href="/punto-verde/dashboard" class="btn btn-secondary">
Volver
</a>

</form>

</div>

</body>
</html>