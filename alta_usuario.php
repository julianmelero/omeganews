<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/

require_once "class/usuarios.php";
$usuario = new usuario();

// Si se ha enviado el formulario lo damos de alta

if(isset($_POST["enviar"])){
  $usuario->set_usuario($_POST["usuario"],$_POST["pass"],$_POST["nombre"],$_POST["apellido1"],$_POST["apellido2"],$_POST["email"],$_POST["telefono"]);
}

?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>OMEGA NEWS - Nuevo Usuario</title>
  </head>
  <body>
    <form class="" action="" method="post">
      <label for="nombre">Usuario*</label>
      <input type="text" required name="usuario">
      <label for="pass">Contrasenya*</label>
      <input type="password" required name="pass">
      <label for="nombre">Nombre*</label>
      <input type="text" required name="nombre">
      <label for="apellido1">Primer Apellido*</label>
      <input type="text" required name="apellido1">
      <label for="apellido2">Segundo Apellido*</label>
      <input type="text" required name="apellido2">
      <label for="email">Email*</label>
      <input type="email" required name="email">
      <label for="telefono">Teléfono*</label>
      <input type="text" required name="telefono">
      <input type="submit" name='enviar' value="Registrarme">
    </form>
  </body>
</html>
