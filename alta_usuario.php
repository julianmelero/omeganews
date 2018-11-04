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
    <form class="" action="index.html" method="post">
      <input type="text" required name="nombre">
      <input type="text" required name="apellido1">
      <input type="text" required name="apellido2">
      <input type="text" required name="email">
      <input type="text" required name="telefono">    
    </form>
  </body>
</html>
