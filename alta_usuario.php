<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/

require_once "class/tipos_usuarios.php";
$tipos = new tipo_usuario();
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
      <input type="text" required name="nombre">
      <label for="apellido1">Primer Apellido*</label>
      <input type="text" required name="apellido1">
      <label for="apellido2">Segundo Apellido*</label>
      <input type="text" required name="apellido2">
      <label for="email">Email*</label>
      <input type="email" required name="email">
      <label for="telefono">Teléfono*</label>
      <input type="text" required name="telefono">
      <input type="submit" value="Registrarme">
    </form>
  </body>
</html>
