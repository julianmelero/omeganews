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
      if (isset($_SESSION["usuario"])) {              
        if ($_SESSION["tipo_usuario"]== "Administrador" or $_SESSION["tipo_usuario"]== "Editor") {
                
        $no_aprobadas = $publicaciones->get_publicaciones_no_aprobadas();
        echo "<h1>Noticias por aprobar</h1>";
        while ($datos = $no_aprobadas[0]->fetch()) {
          echo "<form action='modificar_noticia.php' method='post'>";
          echo "<input type='hidden' name='id' value='".$datos["id"]."' id='id'></input> ";
          echo "<h2>".$datos["titulo"]."</h2>";
          echo "<h3>".$datos["subtitulo"]."</h3>";
          echo "<h4>".date("d-m-Y",strtotime($datos["fecha"]))."</h4>";
          echo substr($datos["texto_noticia"],0,150);
          if (strlen($datos["texto_noticia"])> 150 ) {
            echo "...";
          } 
          echo "<br>";         
          echo "<input type='submit' value='Editar' name='editar'>";
          echo "</form>";
        } 
      }
    }
      $aprobadas = $publicaciones->get_publicaciones();
        echo "<h1>Noticias</h1>";
        while ($datos = $aprobadas[0]->fetch()) {
          echo "<form action='modificar_noticia.php' method='post'>";
          echo "<input type='hidden' name='id' value='".$datos["id"]."' id='id'></input> ";
          echo "<h2>".$datos["titulo"]."</h2>";
          echo "<h3>".$datos["subtitulo"]."</h3>";
          echo "<h4>".date("d-m-Y",strtotime($datos["fecha"]))."</h4>";
          echo substr($datos["texto_noticia"],0,150);
          if (strlen($datos["texto_noticia"])> 150 ) {
            echo "...";
          } 
          echo "<br>";         
          echo "<input type='submit' value='Ver' name='ver'>";
          echo "</form>";
        }
    
      // Aquí ponemos las noticias ya aprobadas, y que pueden ser modificadas sólo por admin y editor


    ?>

  </body>
 
</html>