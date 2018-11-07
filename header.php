<link rel="stylesheet" href="css/estilos.css">

<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/

// Vamos a ver si existe una sesión con el usuario para ver si tiene que cerrar sesión
session_start();
if(! isset($_SESSION["usuario"])){
?>
¡Bienvenido a OMEGA NEWS! <a href="autenticacion.php">Autentifícate</a> o <a href="alta_usuario.php">Regístrate.</a>
<?php
}
else{
?>
¡Hola <?php echo $_SESSION["usuario"] ?>! <a href="cerrar_sesion.php">Cerrar sesión</a>
<?php
}
?>

