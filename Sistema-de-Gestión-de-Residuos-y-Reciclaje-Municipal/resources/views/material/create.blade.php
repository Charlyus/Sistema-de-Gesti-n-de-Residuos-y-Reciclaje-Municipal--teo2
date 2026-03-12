<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Registrar Tipo de Material</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Registrar Tipo de Material</h3>
<div class="d-flex justify-content-end">
    <a href="/material/list" class="btn btn-success">ver Materiales</a>
</div>

<form method="POST" action="/material/store">

@csrf

<div class="mb-3">

<label class="form-label">Nombre del material</label>

<input type="text" name="nombre" class="form-control" required>

</div>


<button class="btn btn-success">
Guardar
</button>

<a href="/punto-verde/dashboard" class="btn btn-secondary">
Volver
</a>

</form>

</div>

</body>
</html>