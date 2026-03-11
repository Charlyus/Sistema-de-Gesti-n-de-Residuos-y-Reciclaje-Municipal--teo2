<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Dashboard Coordinador</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.card-stat{
border-left:5px solid #0d6efd;
}
</style>

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
<div class="container-fluid">
<span class="navbar-brand">Panel Coordinador de Rutas</span>
<a href="/logout" class="btn btn-primary">Cerrar sesión</a>
</div>
</nav>

<div class="container mt-4">

<!-- BOTONES DE ACCIONES -->

<div class="row mb-4">

<div class="col-md-12">

<a href="/rutas/create" class="btn btn-primary">
Nueva Ruta
</a>

<a href="/camiones/create" class="btn btn-success">
Nuevo Camión
</a>

<a href="/recolecciones/create" class="btn btn-warning">
Asignar Camión a Ruta
</a>

</div>

</div>

<!-- ESTADISTICAS -->

<div class="row mb-4">

<div class="col-md-3">
<div class="card card-stat shadow">
<div class="card-body">
<h6>Recolecciones Hoy</h6>
<h3>{{ $recolecciones->count() }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card card-stat shadow">
<div class="card-body">
<h6>En Proceso</h6>
<h3>{{ $recolecciones->where('estado','En proceso')->count() }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card card-stat shadow">
<div class="card-body">
<h6>Completadas</h6>
<h3>{{ $recolecciones->where('estado','Completada')->count() }}</h3>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card card-stat shadow">
<div class="card-body">
<h6>Programadas</h6>
<h3>{{ $recolecciones->where('estado','Programada')->count() }}</h3>
</div>
</div>
</div>

</div>

<!-- TABLA -->

<div class="row">

<div class="col-md-12">

<div class="card shadow">

<div class="card-header bg-primary text-white">
Recolecciones disponibles
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>
<tr>
<th>Ruta</th>
<th>Camión</th>
<th>Fecha</th>
<th>Estado</th>
<th>Acciones</th>
</tr>
</thead>

<tbody>

@foreach($recolecciones as $r)

<tr>

<td>{{ $r->ruta->nombre_identificador }}</td>

<td>{{ $r->camion->placa }}</td>

<td>{{ $r->fecha_programada }}</td>

<td>{{ $r->estado }}</td>

<td>

@if($r->estado == 'Programada')

<a href="/recoleccion/iniciar/{{$r->id_recoleccion}}" 
class="btn btn-success btn-sm">
Procesar Ruta
</a>

@endif

@if($r->estado == 'En proceso')

<a href="/recoleccion/finalizar/{{$r->id_recoleccion}}" 
class="btn btn-danger btn-sm">
Terminar
</a>

@endif

<a href="/recoleccion/mapa/{{$r->id_recoleccion}}" 
class="btn btn-primary btn-sm">
Ver mapa
</a>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>
</div>
</div>

</div>

</div>

</body>
</html>