<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/

// Vamos a ver si existe una sesión con el usuario para ver si tiene que cerrar sesión
session_start();
require_once "./class/usuarios.php";


?>

<header class="nav-header">
  <div class="center-contents">
    <div class="logo"> <img src="./sources/img/OmegaNews.jpg" alt="omega"></div>
    <div class="center-contents">
      <nav class="menu-nav">
        <ul>                  
          <li><a href="index.php">Noticias</a></li>
          <?php   if(!isset($_SESSION["usuario"])){  ?>
          <li><a href="alta_usuario.php">Registro</a></li>
          <li><a href="autenticacion.php">Login</a></li>
          <li><a href="nosotros.php">Nosotros</a></li>
          <?php } ?>
          <?php if(isset($_SESSION["usuario"])){
            $usuario = new usuario();
            $tipo = $usuario->tipo_usuario($_SESSION["usuario"]);
            if ($tipo == "Administrador"){                      
            ?>                    
          <li><a href="miembros.php">Miembros</a></li>
            <?php } 
            if ($tipo == "Periodista" or $tipo == "Administrador") {                      
            ?>
          <li><a href="publicar_noticias.php">Publicar noticia</a></li>
            <?php
            }
            ?>
          <li><a href="mis_datos.php"><?php echo $_SESSION["usuario"]; ?> (<?php echo $_SESSION["tipo_usuario"]; ?>) </a></li>
          <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
</header>