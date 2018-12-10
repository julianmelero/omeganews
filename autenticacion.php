
<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/

if(isset($_POST["entrar"])){
    require_once "class/usuarios.php";
    $usuarios = new usuario();
    $usuarios->autenticacion($_POST["usuario"],$_POST["pwd"]);


}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMEGA NEWS - Autenticación</title>
    <?php require_once "head.php"; ?>  
</head>
 
<body>
<?php require_once "header.php"; ?>
<form action="autenticacion.php" method="post">
    <label for="usuario">Usuario</label>
    <input type="text" maxlength='30' required placeholder="Usuario..." autofocus name="usuario">
    <label for="pwd">Contraseña</label>
    <input type="password" required placeholder="Escriba su contraseña..." name="pwd">
    <input type="submit" name="entrar" value="¡Entrar!">
</form>
<p>Si quieres crear noticias con nosotros,</p> <a href="alta_usuario.php"> <p>¡Regístrate!</p></a>
</body>
</html>
