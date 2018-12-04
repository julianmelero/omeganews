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
      require_once "class/usuarios.php";
      $publicaciones = new publicacion();
      $usuarios = new usuario();
      $aprobadas = $publicaciones->get_publicacion($_POST["id"]);        
        while ($datos = $aprobadas[0]->fetch()) {
          $dir = "img_noticias/".$datos["id"]."/".$datos["url_img"];
          echo "<form action='modificar_noticia.php' method='post'>";
          echo "<input type='hidden' name='id' value='".$datos["id"]."' id='id'></input> ";          
          $d_usuario = $usuarios->get_usuario($datos["id_usuario"]);
          while ($usuario = $d_usuario[0]->fetch()) {
          echo "Autor: ".$usuario["nombre"]." ".$usuario["ape1"]." ".$usuario["ape2"];
          }
          echo "<h4> Fecha: ".date("d-m-Y",strtotime($datos["fecha"]))."</h4>";
          echo "<h2>".$datos["titulo"]."</h2>";
          echo "<h3>".$datos["subtitulo"]."</h3>"; 
          echo "<img alt='noticia' src='".$dir."'  width='250px' heigth='200px'><br>";         
          echo substr($datos["texto_noticia"],0,150);
          if (strlen($datos["texto_noticia"])> 150 ) {
            echo "...";
          } 
          echo "<br>";         
          echo "<a href='index.php'>Volver</a>";
          echo "</form>";
        }
    
      // Aquí ponemos las noticias ya aprobadas, y que pueden ser modificadas sólo por admin y editor


    ?>

  </body>
 
</html>