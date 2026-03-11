<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Mapa de Recolección</title>

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

<h3>
Ruta: {{ $recoleccion->ruta->nombre_identificador }}
</h3>

<a href="/coordinador/dashboard" class="btn btn-secondary mb-3">
Volver
</a>

<div id="map"></div>

</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="https://unpkg.com/leaflet-polylinedecorator/dist/leaflet.polylineDecorator.js"></script>

<script>

var map = L.map('map').setView([14.845, -91.518], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
maxZoom:19
}).addTo(map);


// puntos de recoleccion
var puntos = @json($puntos);

puntos.forEach(function(p){

L.marker([parseFloat(p.latitud),parseFloat(p.longitud)])
.addTo(map)
.bindPopup("Basura estimada: "+p.volumen_estimado_kg+" kg");

});


// ruta
var ruta = @json($recoleccion->ruta->puntos_intermedios);

// si viene como string lo convertimos
if(typeof ruta === "string"){
    ruta = JSON.parse(ruta);
}

var coordenadas = ruta.map(function(p){
    return [parseFloat(p.lat), parseFloat(p.lng)];
});


// dibujar ruta
var polyline = L.polyline(coordenadas,{
color:'blue',
weight:5
}).addTo(map);


// marcador inicio
L.marker(coordenadas[0])
.addTo(map)
.bindPopup("<b>Inicio de la ruta</b>");


// marcador final
L.marker(coordenadas[coordenadas.length-1])
.addTo(map)
.bindPopup("<b>Fin de la ruta</b>");


map.fitBounds(polyline.getBounds());

</script>

</body>
</html>