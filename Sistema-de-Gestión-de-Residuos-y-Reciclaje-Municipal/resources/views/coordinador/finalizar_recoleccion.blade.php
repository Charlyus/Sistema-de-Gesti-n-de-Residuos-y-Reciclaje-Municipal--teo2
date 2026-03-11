<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Finalizar Recolección</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Finalizar Recolección</h3>

<form method="POST" action="/recoleccion/finalizar">

@csrf

<input type="hidden" name="id_recoleccion" value="{{$recoleccion->id_recoleccion}}">

<div class="mb-3">

<label class="form-label">Estado de la ruta</label>

<select name="estado" class="form-control">

<option value="Completada">Completada</option>
<option value="Incompleta">Incompleta</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">Observaciones (opcional)</label>

<textarea name="observaciones" class="form-control"></textarea>

</div>

<button class="btn btn-primary">
Finalizar ruta
</button>

</form>

</div>

</body>
</html>