<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Dashboard Ciudadano</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Panel del Ciudadano</h3>
<div class="d-flex justify-content-end">
    <a href="/logout" class="btn btn-success">cerrar sesion</a>
</div>
<div class="row mt-4">

<div class="col-md-6">

<a href="/denuncia/create" class="btn btn-danger w-100 p-4">
Registrar denuncia
</a>

</div>

<div class="col-md-6">

<a href="/denuncia/mis-denuncias" class="btn btn-primary w-100 p-4">
Ver estado de mis denuncias
</a>

</div>

</div>

</div>

</body>
</html>