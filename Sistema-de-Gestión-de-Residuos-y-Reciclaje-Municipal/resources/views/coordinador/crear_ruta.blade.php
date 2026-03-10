<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<title>Nueva Ruta</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<style>

#map{
height:500px;
width:100%;
border-radius:10px;
}

</style>

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Nueva Ruta</h3>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<form method="POST" action="/rutas/guardar">

@csrf

<div class="mb-3">
<label>Nombre de Ruta</label>
<input type="text" name="nombre" class="form-control" required>
</div>

<input type="hidden" id="puntos" name="puntos">

<div id="map"></div>

<br>
<div class="mb-3">
<label>Zona</label>
<select name="id_zona" class="form-control">
@foreach($zonas as $zona)
<option value="{{ $zona->id_zona }}">
{{ $zona->nombre }}
</option>
@endforeach
</select>
</div>

<div class="mb-3">
<label>Tipo de Residuo</label>
<select name="id_tipo_residuo" class="form-control">
@foreach($tipos as $tipo)
<option value="{{ $tipo->id_tipo_residuo }}">
{{ $tipo->nombre }}
</option>
@endforeach
</select>
</div>

<div class="mb-3">
<label>Horario inicio</label>
<input type="time" name="horario_inicio" class="form-control">
</div>

<div class="mb-3">
<label>Horario fin</label>
<input type="time" name="horario_fin" class="form-control">
</div>

<button class="btn btn-primary">
Guardar Ruta
</button>

<a href="/coordinador/dashboard" class="btn btn-secondary">
Volver
</a>

</form>

</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

var map = L.map('map').setView([14.845, -91.518], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
maxZoom:19
}).addTo(map);

var puntos = [];

var polyline = L.polyline([], {color:'blue'}).addTo(map);

map.on('click', function(e){

var lat = e.latlng.lat;
var lng = e.latlng.lng;

puntos.push({
lat:lat,
lng:lng
});

L.marker([lat,lng]).addTo(map);

polyline.setLatLngs(puntos.map(p => [p.lat,p.lng]));

document.getElementById("puntos").value = JSON.stringify(puntos);

});

</script>

</body>
</html>