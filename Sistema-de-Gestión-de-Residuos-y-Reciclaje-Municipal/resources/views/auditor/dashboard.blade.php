<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Panel Auditor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h2 class="mb-4">Dashboard Auditor</h2>
<div class="d-flex justify-content-end">
    <a href="/logout" class="btn btn-success">cerrar sesion</a>
</div>

<h4>Toneladas recolectadas por periodo</h4>

<form method="GET" action="/auditor/dashboard" class="row mb-3">

<div class="col-md-3">
<label>Fecha inicio</label>
<input type="date" name="inicio" value="{{$inicio}}" class="form-control">
</div>

<div class="col-md-3">
<label>Fecha fin</label>
<input type="date" name="fin" value="{{$fin}}" class="form-control">
</div>

<div class="col-md-3 d-flex align-items-end">
<button class="btn btn-primary">Consultar</button>
</div>

</form>

@if($toneladasPeriodo)

<div class="alert alert-success">

Toneladas recolectadas:  
<strong>{{number_format($toneladasPeriodo->toneladas ?? 0,2)}} toneladas</strong>

</div>

@endif




<h4>Material reciclado por tipo</h4>

<table class="table table-bordered">

<tr>
<th>Material</th>
<th>Kg reciclados</th>
</tr>

@foreach($materiales as $m)

<tr>
<td>{{$m->nombre}}</td>
<td>{{$m->total_kg}}</td>
</tr>

@endforeach

</table>



<h4>Puntos verdes más activos</h4>

<table class="table table-bordered">

<tr>
<th>Punto verde</th>
<th>Kg recibidos</th>
</tr>

@foreach($puntosActivos as $p)

<tr>
<td>{{$p->nombre}}</td>
<td>{{$p->total_kg}}</td>
</tr>

@endforeach

</table>



<h4>Estado de denuncias</h4>

<table class="table table-bordered">

<tr>
<th>Estado</th>
<th>Cantidad</th>
</tr>

@foreach($denuncias as $d)

<tr>
<td>{{$d->nombre}}</td>
<td>{{$d->total}}</td>
</tr>

@endforeach

</table>

</div>

</body>
</html>