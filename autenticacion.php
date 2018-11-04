<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>OMEGA NEWS - Autenticación</title>
</head>
<header>
 <!-- Aquí no llammos al header ya que si no hay redundancia con la llamada a la autenticación --> 
  </header>
<body>

<form action="autenticacion.php" method="post">
    <label for="usuario">Usuario</label>
    <input type="text" maxlength='30' required placeholder="Usuario..." autofocus name="usuario">
    <label for="pwd">Contraseña</label>
    <input type="password" required placeholder="Escriba su contraseña..." name="contraseña">
    <input type="submit" value="¡Entrar!">
</form>
</body>
</html>