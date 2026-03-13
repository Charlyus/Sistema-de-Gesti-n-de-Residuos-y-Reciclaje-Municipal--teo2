<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Mis denuncias</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Mis Denuncias</h3>

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>ID</th>
<th>Descripción</th>
<th>Tamaño</th>
<th>Estado</th>
<th>Fecha</th>
<th>Foto</th>
</tr>
</thead>

<tbody>

@foreach($denuncias as $d)

<tr>

<td>{{$d->id_denuncia}}</td>

<td>{{$d->descripcion}}</td>

<td>{{$d->tamano}}</td>

<td>
<span class="badge bg-warning">
{{$d->estado}}
</span>
</td>

<td>{{$d->fecha_creacion}}</td>

<td>

@if($d->foto_url)
<img src="{{asset('storage/'.$d->foto_url)}}" width="80">
@endif

</td>

</tr>

@endforeach

</tbody>

</table>

<a href="/ciudadano/dashboard" class="btn btn-secondary">
Volver
</a>

</div>

</body>
</html>