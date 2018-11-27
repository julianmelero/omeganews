<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/


?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>OMEGA NEWS</title>
    <?php require_once "head.php"; ?>  
  </head>
    <body>
    <?php require_once "header.php"; ?>


    <?php
      // Primero mostramos las noticias que faltan por revisar
      require_once "class/publicacion.php";
      $publicaciones = new publicacion();
      $no_aprobadas = $publicaciones->get_publicaciones_no_aprobadas();
      while ($datos = $no_aprobadas[0]->fetch()) {
        echo "<h1>".$datos["titulo"]."</h1>";
      } 

      // Aquí ponemos las noticias ya aprobadas, y que pueden ser modificadas sólo por admin y editor


    ?>

  </body>
 
</html>