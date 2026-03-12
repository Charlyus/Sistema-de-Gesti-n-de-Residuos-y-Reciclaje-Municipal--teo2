<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Entregas de Reciclaje</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Historial de Entregas</h3>
<div class="d-flex justify-content-end">
    <a href="/punto-verde/dashboard" class="btn btn-success">inicio</a>
</div>

<table class="table table-bordered">

<thead>

<tr>
<th>ID</th>
<th>Punto Verde</th>
<th>Material</th>
<th>Cantidad</th>
<th>Ciudadano</th>
<th>Fecha</th>
</tr>

</thead>

<tbody>

@foreach($entregas as $e)

<tr>

<td>{{$e->id_entrega}}</td>
<td>{{$e->puntoVerde->nombre}}</td>
<td>{{$e->material->nombre}}</td>
<td>{{$e->cantidad_kg}} kg</td>

<td>
@if($e->usuario)
{{$e->usuario->nombre}}
@else
Entrega anónima
@endif
</td>

<td>{{$e->fecha_hora}}</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</body>
</html>