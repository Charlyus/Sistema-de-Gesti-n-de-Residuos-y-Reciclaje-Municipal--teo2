<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Registrar denuncia</title>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Registrar denuncia</h3>

<form method="POST" action="/denuncia/store" enctype="multipart/form-data">

@csrf

<div class="mb-3">

<label>Descripción</label>

<textarea name="descripcion" class="form-control" required></textarea>

</div>

<div class="mb-3">

<label>Tamaño del problema</label>

<select name="tamano" class="form-control">

<option>Pequeño</option>
<option>Mediano</option>
<option>Grande</option>

</select>

</div>

<div class="mb-3">

<label>Foto (opcional)</label>

<input type="file" name="foto" class="form-control">

</div>

<input type="hidden" name="latitud" id="latitud">
<input type="hidden" name="longitud" id="longitud">

<div id="map" style="height:400px"></div>

<button class="btn btn-danger mt-3">
Registrar denuncia
</button>

<a href="/ciudadano/dashboard" class="btn btn-secondary mt-3">
Cancelar
</a>

</form>

</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

var map = L.map('map').setView([14.845,-91.518],13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
maxZoom:19
}).addTo(map);

var marker;

map.on('click',function(e){

if(marker){
map.removeLayer(marker);
}

marker = L.marker(e.latlng).addTo(map);

document.getElementById('latitud').value = e.latlng.lat;
document.getElementById('longitud').value = e.latlng.lng;

});

</script>

</body>
</html>