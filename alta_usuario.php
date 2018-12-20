<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/

require_once "class/usuarios.php";
$usuario = new usuario();

// Si se ha enviado el formulario lo damos de alta

if(isset($_POST["enviar"])){
  $usuario->set_usuario($_POST["usuario"],$_POST["nombre"],$_POST["pass"],$_POST["pass2"],$_POST["apellido1"],$_POST["apellido2"],$_POST["email"],$_POST["telefono"]);
}

?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>OMEGA NEWS - Nuevo Usuario</title>
    <?php require_once "head.php"; ?>
  </head>
  
  <body>  
  <?php require_once "header.php"; ?>
  <h1>Alta de Usuario</h1>
    <form name="alta" id="alta" class="" action="" method="post" onsubmit="return comprobar();">
      <label for="usuario">Usuario*</label>
      <input type="text" required name="usuario" id="usuario" value='<?php if(isset($_POST["usuario"])){ echo $_POST["usuario"]; } ?>'>
      <label for="pass">Contraseña*</label>
      <input type="password" required name="pass" id="pass" id="pass" >
      <label for="pass2">Repita Contraseña*</label>
      <input type="password" required name="pass2" id="pass2" id="pass2" >
      <label for="nombre">Nombre*</label>
      <input type="text" required name="nombre" id="nombre" value='<?php  if(isset($_POST["nombre"])){ echo $_POST["nombre"]; } ?>' >
      <label for="apellido1">Primer Apellido*</label>
      <input type="text" required name="apellido1" id="apellido1" value='<?php  if(isset($_POST["apellido1"])){ echo $_POST["apellido1"]; } ?>' >
      <label for="apellido2">Segundo Apellido*</label>
      <input type="text" required name="apellido2" id="apellido2" value='<?php if(isset($_POST["apellido2"])){ echo $_POST["apellido2"]; } ?>'>
      <label for="email">Email*</label>
      <input type="email" required name="email" id="email" value='<?php if(isset($_POST["email"])){ echo $_POST["email"]; } ?>'>
      <label for="telefono">Teléfono*</label>
      <input type="text" required name="telefono" id="telefono" value='<?php if(isset($_POST["telefono"])){ echo $_POST["telefono"]; } ?>'>
      <input type="submit" name='enviar' value="Registrarme">
    </form>
    <script>
      function comprobar(){
        var pass1 = $('#pass').val();
        var pass2 = $('#pass2').val();
        if (pass1!=pass2) {
          alert('Las contraseñas no coinciden');
          return false;
        }
      } 
    </script>

  </body>
</html>
