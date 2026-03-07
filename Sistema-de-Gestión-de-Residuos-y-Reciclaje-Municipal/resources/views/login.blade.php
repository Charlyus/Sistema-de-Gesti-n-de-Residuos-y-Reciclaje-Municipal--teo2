<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

@if(session('error'))
<p style="color:red">{{ session('error') }}</p>
@endif

<form method="POST" action="/login">
@csrf

<label>Correo</label>
<input type="email" name="correo" required>

<br><br>

<label>Password</label>
<input type="password" name="password" required>

<br><br>

<button type="submit">Ingresar</button>

</form>

</body>
</html>