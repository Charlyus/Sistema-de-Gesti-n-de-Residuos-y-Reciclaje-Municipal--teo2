<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Crear Ruta</title>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

#map{
height:500px;
border-radius:10px;
}

</style>

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Crear Ruta de Recolección</h3>

<div class="card shadow">

<div class="card-body">

<form method="POST" action="{{ route('rutas.guardar') }}">

@csrf

<div class="mb-3">

<label>Nombre de Ruta</label>

<input type="text" name="nombre" class="form-control" required>

</div>

<input type="hidden" name="puntos" id="puntos">

<div id="map"></div>

<button class="btn btn-success mt-3">
Guardar Ruta
</button>

<button type="button" id="limpiar" class="btn btn-danger mt-3">
Limpiar Ruta
</button>

</form>

</div>

</div>

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

puntos.push({lat:lat,lng:lng});

L.marker([lat,lng]).addTo(map);

polyline.setLatLngs(puntos.map(p => [p.lat,p.lng]));

document.getElementById("puntos").value = JSON.stringify(puntos);

});

document.getElementById("limpiar").onclick = function(){

puntos = [];
polyline.setLatLngs([]);

map.eachLayer(function(layer){
if(layer instanceof L.Marker){
map.removeLayer(layer);
}
});

};

</script>

</body>
</html>