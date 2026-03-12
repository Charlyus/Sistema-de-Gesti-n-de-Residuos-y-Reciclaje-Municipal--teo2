<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Puntos Verdes</title>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

#map{
height:600px;
border-radius:10px;
}

</style>

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Puntos Verdes de la Ciudad</h3>

<a href="/punto-verde/dashboard" class="btn btn-secondary mb-3">
Volver
</a>

<div id="map"></div>

</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

var map = L.map('map').setView([14.845, -91.518], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
maxZoom:19
}).addTo(map);

var puntos = @json($puntos);

puntos.forEach(function(p){

L.marker([p.latitud,p.longitud])
.addTo(map)
.bindPopup(
"<b>"+p.nombre+"</b><br>"+
p.direccion+"<br>"+
"Capacidad: "+p.capacidad_total_m3+" m³"
);

});

</script>

</body>
</html>