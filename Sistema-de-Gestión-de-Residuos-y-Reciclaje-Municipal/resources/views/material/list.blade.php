<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Tipos de Material</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Tipos de Material Registrados</h3>

<a href="/material/create" class="btn btn-primary mb-3">
Nuevo material
</a>

<table class="table table-bordered">

<thead>

<tr>
<th>ID</th>
<th>Material</th>
</tr>

</thead>

<tbody>

@foreach($materiales as $m)

<tr>

<td>{{$m->id_tipo_material}}</td>
<td>{{$m->nombre}}</td>

</tr>

@endforeach

</tbody>

</table>

<a href="/punto-verde/dashboard" class="btn btn-secondary">
Volver
</a>

</div>

</body>
</html>