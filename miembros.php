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
	<?php require_once "header.php"; 
	if(!isset($_SESSION["usuario"])){  
    header("Location: index.php");
  	}
	require_once "class/usuarios.php";
	$usuario = new usuario();
	$datos = $usuario->get_usuarios();
	while($usuarios = $datos[0]->fetch()){		
	?>   
    <div class="divProg">
			<div class="miembros">				
				<h3><?php echo $usuarios["nombre"]." ".$usuarios["ape1"]." ".$usuarios["ape2"];  ?></h3>
				
			</div>			
		</div>
	<?php }?>
  </body>
</html>
