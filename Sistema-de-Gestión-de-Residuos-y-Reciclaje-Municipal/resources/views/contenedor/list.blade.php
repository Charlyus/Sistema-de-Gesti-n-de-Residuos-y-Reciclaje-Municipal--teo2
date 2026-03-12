<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Contenedores</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Contenedores</h3>

<a href="/contenedor/create" class="btn btn-primary mb-3">
Nuevo contenedor
</a>

<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Punto Verde</th>
<th>Material</th>
<th>Llenado</th>
<th>Última limpieza</th>

</tr>

</thead>

<tbody>

@foreach($contenedores as $c)

<tr>

<td>{{$c->id_contenedor}}</td>
<td>{{$c->puntoVerde->nombre}}</td>
<td>{{$c->material->nombre}}</td>
<td>{{$c->porcentaje_llenado}} %</td>
<td>{{$c->ultima_limpieza}}</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</body>
</html>