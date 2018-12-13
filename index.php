<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/


?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Noticias OMEGA</title>
    <?php require_once "head.php"; ?>  
  </head>
  <body>
    <?php require_once "header.php"; 
        require_once "class/secciones.php";
        $secciones = new secciones();
        
      // Primero mostramos las noticias que faltan por revisar
      require_once "class/publicacion.php";
      require_once "class/usuarios.php";
      $usuarios = new usuario();
      $publicaciones = new publicacion();
      if (isset($_SESSION["usuario"])) {              
        if ($_SESSION["tipo_usuario"]== "Administrador" or $_SESSION["tipo_usuario"]== "Editor") {
                
        $no_aprobadas = $publicaciones->get_publicaciones_no_aprobadas();
        echo "<h1>Noticias por aprobar</h1>";
        while ($datos = $no_aprobadas[0]->fetch()) {
          $dir = "img_noticias/".$datos["id"]."/".$datos["url_img"];
          echo "<form action='modificar_noticia.php' method='post'>";
          $d_usuario = $usuarios->get_usuario($datos["id_usuario"]);
          while ($usuario = $d_usuario[0]->fetch()) {
            echo "Autor: ". $usuario["nombre"]." ".$usuario["ape1"]." ".$usuario["ape2"];
          }      
          echo "<input type='hidden' name='id' value='".$datos["id"]."' id='id'>";
          echo "<h2>".$datos["titulo"]."</h2>";
          echo "<img src='".$dir."'  class='imagen' alr='imagen'>";
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

    ?>
      
    <!--select para elegir las secciones de noticias-->
    <div name="filtros">
        <form action="index.php" method="post">
          <label for="seccion"></label>
          <select name="filtro" id="seccion">
            <option value="Todas">Todas</option>
            <?php
            $datos = $secciones->get_secciones();
            while($seccion = $datos[0]->fetch()){ ?>
<option value="<?php echo $seccion["id"]; ?>"><?php echo $seccion["nombre"]; ?></option>
            <?php } ?>
</select>
          <button type="submit">Filtrar</button>
        </form>
    </div>    
    <?php
    if(isset($_POST['filtro'])){
        
        switch($_POST['filtro']){
        case "Todas":
        
     // Las noticias aprobadas sin filtrar
      $aprobadas = $publicaciones->get_publicaciones();
      
        echo "<div><h1>Noticias</h1>";
        while ($datos = $aprobadas[0]->fetch()) {
          $dir = "img_noticias/".$datos["id"]."/".$datos["url_img"];
          echo "<form action='noticia.php' method='post'>";
          echo "<input type='hidden' name='id' value='".$datos["id"]."' id='id'>";
          $d_usuario = $usuarios->get_usuario($datos["id_usuario"]);
          while ($usuario = $d_usuario[0]->fetch()) {
            echo "Autor: ". $usuario["nombre"]." ".$usuario["ape1"]." ".$usuario["ape2"];
        }
          echo "<h2>".$datos["titulo"]."</h2>";
          echo "<h3>".$datos["subtitulo"]."</h3>";
          echo "<img class='imagen' alt='noticia' src='".$dir."'>";
          echo "<h4>".date("d-m-Y",strtotime($datos["fecha"]))."</h4>";
          echo substr($datos["texto_noticia"],0,150);
          if (strlen($datos["texto_noticia"])> 150 ) {
            echo "...";
          } 
          echo "<br>";         
          echo "<input type='submit' value='Ver' name='ver'>";
          echo "</form></div>";
        }
    
     
        break;
        default:
        
         //Noticias filtradas por sección  
            $filtradas = $publicaciones->tipo_seccion($_POST['filtro']);
      
        echo "<h1>Noticias</h1>";
        while ($datos = $filtradas[0]->fetch()) {
          $dir = "img_noticias/".$datos["id"]."/".$datos["url_img"];
          echo "<form action='noticia.php' method='post'>";
          echo "<input type='hidden' name='id' value='".$datos["id"]."' id='id'></input> ";
          $d_usuario = $usuarios->get_usuario($datos["id_usuario"]);
          while ($usuario = $d_usuario[0]->fetch()) {
            echo "Autor: ". $usuario["nombre"]." ".$usuario["ape1"]." ".$usuario["ape2"];
        }
          echo "<h2>".$datos["titulo"]."</h2>";
          echo "<h3>".$datos["subtitulo"]."</h3>";
          echo "<img class='imagen' alt='noticia' src='".$dir."'>";
          echo "<h4>".date("d-m-Y",strtotime($datos["fecha"]))."</h4>";
          echo substr($datos["texto_noticia"],0,150);
          if (strlen($datos["texto_noticia"])> 150 ) {
            echo "...";
          } 
          echo "<br>";         
          echo "<input type='submit' value='Ver' name='ver'>";
          echo "</form>";
        }
        break;
        }
        }else{
        
      // Las noticias aprobadas sin filtrar
      $aprobadas = $publicaciones->get_publicaciones();
      
        echo "<h1>Noticias</h1>";
        while ($datos = $aprobadas[0]->fetch()) {
          $dir = "img_noticias/".$datos["id"]."/".$datos["url_img"];
          echo "<form action='noticia.php' method='post'>";
          echo "<input type='hidden' name='id' value='".$datos["id"]."' id='id'></input> ";
          $d_usuario = $usuarios->get_usuario($datos["id_usuario"]);
          while ($usuario = $d_usuario[0]->fetch()) {
            echo "Autor: ". $usuario["nombre"]." ".$usuario["ape1"]." ".$usuario["ape2"];
        }
          echo "<h2>".$datos["titulo"]."</h2>";
          echo "<h3>".$datos["subtitulo"]."</h3>";
          echo "<img class='imagen' alt='noticia' src='".$dir."'>";
          echo "<h4>".date("d-m-Y",strtotime($datos["fecha"]))."</h4>";
          echo substr($datos["texto_noticia"],0,150);
          if (strlen($datos["texto_noticia"])> 150 ) {
            echo "...";
          } 
          echo "<br>";         
          echo "<input type='submit' value='Ver' name='ver'>";
          echo "</form>";
        }
        }
        ?>       

    <?php
      // Aquí ponemos las noticias ya aprobadas, y que pueden ser modificadas sólo por admin y editor


    ?>

  </body>
 
</html>