<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Registrar Entrega</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Registrar Entrega de Reciclaje</h3>
<div class="d-flex justify-content-end">
    <a href="/entrega/list" class="btn btn-success">ver historial de entregas</a>
</div>

<form method="POST" action="/entrega/store">

@csrf

<div class="mb-3">

<label>Punto Verde</label>

<select name="id_punto_verde" class="form-control">

<option value="">Seleccione un punto verde</option>

@foreach($puntos as $p)

<option value="{{$p->id_punto_verde}}">
{{$p->nombre}}
</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Tipo de Material</label>

<select name="id_tipo_material" class="form-control">

<option value="">Seleccione material</option>

@foreach($materiales as $m)

<option value="{{$m->id_tipo_material}}">
{{$m->nombre}}
</option>

@endforeach

</select>

</div>
<div class="mb-3">

<label>Contenedor disponible</label>

<select name="id_contenedor" id="contenedor" class="form-control" required>

<option value="">Seleccione primero punto verde y material</option>

</select>

</div>
<div class="mb-3">

<label>Cantidad (kg)</label>

<input type="number" step="0.01" name="cantidad_kg" class="form-control" required>

</div>

<div class="mb-3">

<label>Ciudadano (opcional)</label>

<select name="id_usuario" class="form-control">

<option value="">Entrega anónima</option>

@foreach($ciudadanos as $c)

<option value="{{$c->id_usuario}}">
ID {{$c->id_usuario}} - {{$c->nombre}}
</option>

@endforeach

</select>

</div>

<button class="btn btn-success">
Registrar entrega
</button>

<a href="/punto-verde/dashboard" class="btn btn-secondary">
Volver
</a>

</form>
<script>

document.querySelector('[name="id_punto_verde"]').addEventListener('change', cargarContenedores);
document.querySelector('[name="id_tipo_material"]').addEventListener('change', cargarContenedores);

function cargarContenedores(){

let punto = document.querySelector('[name="id_punto_verde"]').value;
let material = document.querySelector('[name="id_tipo_material"]').value;

if(!punto || !material) return;

fetch(`/contenedores-disponibles?id_punto_verde=${punto}&id_tipo_material=${material}`)
.then(res=>res.json())
.then(data=>{

let select = document.getElementById('contenedor');

select.innerHTML = "";

if(data.length === 0){

select.innerHTML = "<option>No hay contenedores disponibles</option>";
return;

}

data.forEach(c=>{

let porcentaje = (c.cantidad_actual_kg / c.capacidad_kg) * 100;

select.innerHTML += `
<option value="${c.id_contenedor}">
Contenedor ${c.id_contenedor} - ${porcentaje.toFixed(1)}% lleno
</option>`;

});

});

}

</script>

</div>

</body>
</html>