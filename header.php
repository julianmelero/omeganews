<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/


// Vamos a ver si existe una sesión con el usuario, en caso contratio lo mandamos a autenticar

if(!isset($_SESSION["usuario"])){
  header('Location: autenticacion.php');
}

?>