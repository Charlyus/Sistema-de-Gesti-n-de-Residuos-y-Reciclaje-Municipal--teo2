<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Gestión de Denuncias</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Gestión de Denuncias</h3>
<div class="d-flex justify-content-end">
    <a href="/admin/dashboard" class="btn btn-success">volver</a>
</div>
<table class="table table-bordered">

<thead>
<tr>
<th>ID</th>
<th>Ciudadano</th>
<th>Descripción</th>
<th>Tamaño</th>
<th>Estado</th>
<th>Foto</th>
<th>Cambiar Estado</th>
</tr>
</thead>

<tbody>

@foreach($denuncias as $d)

<tr>

<td>{{$d->id_denuncia}}</td>

<td>{{$d->ciudadano}}</td>

<td>{{$d->descripcion}}</td>

<td>{{$d->tamano}}</td>

<td>
<span class="badge bg-warning">
{{$d->estado}}
</span>
</td>

<td>

@if($d->foto_url)
<a href="{{asset('storage/'.$d->foto_url)}}" target="_blank">
<img src="{{asset('storage/'.$d->foto_url)}}" width="70">
</a>
@endif

</td>

<td>

<form method="POST" action="/admin/denuncia/cambiar-estado">

@csrf

<input type="hidden" name="id_denuncia" value="{{$d->id_denuncia}}">

<select name="id_estado" class="form-control mb-2">

@foreach($estados as $e)

<option value="{{$e->id_estado_denuncia}}">
{{$e->nombre}}
</option>

@endforeach

</select>

<button class="btn btn-primary btn-sm">
Actualizar
</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</body>

</html>