<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/

// Vamos a ver si existe una sesión con el usuario para ver si tiene que cerrar sesión
session_start();

?>

 <header class="nav-header">
       <div class="center-contents">
          <a class="logo" href="index.php" title=""><img src="./sources/img/OmegaNews.jpg" alt=""></a>
         <div class="center-contents">
          <nav class="menu-nav">
            <ul>                  
                    <li><a href="index.php">Inicio</a></li>
                    <?php   if(!isset($_SESSION["usuario"])){  ?>
                    <li><a href="alta_usuario.php">Registro</a></li>
                    <li><a href="autenticacion.php">Login</a></li>
                    <li><a href="nosotros.php">Nosotros</a></li>
                    <?php } ?>
                    <?php if(isset($_SESSION["usuario"])){  ?>                    
                        <li><a href="miembros.php">Miembros</a></li>
                        <li><a href="publicar_noticias.php">Publicar noticia</a></li>                        
                        <li><a href="#"><?php echo $_SESSION["usuario"]; ?></a></li>
                        <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
                    <?php } ?>
            </ul>
          </nav>
        </div>
        </div>
         
      </header>