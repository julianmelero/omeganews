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
	<table>
				<tr>
					<th>Nombre</th>
					<th>Tipo Usuario</th>
					<th>Acción</th>
				</tr>
				<div class="divProg">
	<?php require_once "header.php"; 
	if(!isset($_SESSION["usuario"])){  
    header("Location: index.php");
  	}
	require_once "class/usuarios.php";
	$usuario = new usuario();
	$tipos = new tipo_usuario();
	$datos = $usuario->get_usuarios();
	
		// Si quiere ser Periodista

		if(isset($_POST["periodista"])){
			$usuario->set_tipo_usuario(1,$_POST["id"]);
			header("Location: miembros.php");
		}

		if(isset($_POST["editor"])){
			$usuario->set_tipo_usuario(2,$_POST["id"]);
			header("Location: miembros.php");
		}

		if(isset($_POST["administrador"])){
			$usuario->set_tipo_usuario(3,$_POST["id"]);
			header("Location: miembros.php");
		}









	// Recorremos los datos de los usuarios
	while($usuarios = $datos[0]->fetch()){		
		//Cogemos el tipo de usuario
		$nombre_tipo = $tipos->get_tipo_usuario($usuarios["id_tipo_usuario"]);

	?>   
		<form action="" method="post">
    
			<div class="miembros">					
				<tr>				
					<td><input type="hidden" name="id" value=' <?php echo $usuarios["id"];  ?>'><?php echo $usuarios["nombre"]." ".$usuarios["ape1"]." ".$usuarios["ape2"];  ?></td>
					<td><?php echo $nombre_tipo;  ?></td>
					<td>
						<input type="submit" name='periodista' value="Convertir a Periodista">	
						<input type="submit" name="editor" value="Convertir a Editor">
						<input type="submit" name="administrador" value="Convertir a Administrador">
				<hr>				
				</td>
				</tr>
			
			</div>			
		
		</form>
	<?php }?>
	</table>
	</div>
  </body>
</html>
