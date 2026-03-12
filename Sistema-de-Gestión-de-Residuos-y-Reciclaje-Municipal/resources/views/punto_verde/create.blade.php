<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Registrar Punto Verde</title>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

#map{
height:400px;
border-radius:10px;
}

</style>

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Registrar Punto Verde</h3>

<form method="POST" action="/punto-verde/store">

@csrf

<div class="mb-3">

<label class="form-label">Nombre</label>

<input type="text" name="nombre" class="form-control" required>

</div>

<div class="mb-3">

<label class="form-label">Dirección</label>

<textarea name="direccion" class="form-control" required></textarea>

</div>

<div class="mb-3">

<label class="form-label">Capacidad total (m³)</label>

<input type="number" step="0.01" name="capacidad_total_m3" class="form-control">

</div>

<div class="mb-3">

<label class="form-label">Horario de atención</label>

<input type="text" name="horario_atencion" class="form-control">

</div>
<div class="mb-3">

<label class="form-label">Encargado del Punto Verde</label>

<select name="encargado_id" class="form-control" required>

<option value="">Seleccione un empleado</option>

@foreach($empleados as $empleado)

<option value="{{$empleado->id_usuario}}">
{{$empleado->nombre}}
</option>

@endforeach

</select>

</div>

<input type="hidden" name="latitud" id="latitud">
<input type="hidden" name="longitud" id="longitud">

<label class="form-label">Seleccionar ubicación en el mapa</label>

<div id="map"></div>

<br>

<button class="btn btn-success">
Guardar Punto Verde
</button>

<a href="/punto-verde/dashboard" class="btn btn-secondary">
Cancelar
</a>

</form>

</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

var map = L.map('map').setView([14.845, -91.518], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
maxZoom:19
}).addTo(map);

var marker;

map.on('click', function(e){

var lat = e.latlng.lat;
var lng = e.latlng.lng;

document.getElementById('latitud').value = lat;
document.getElementById('longitud').value = lng;

if(marker){
map.removeLayer(marker);
}

marker = L.marker([lat,lng]).addTo(map);

});

</script>

</body>
</html>