
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible">
    <title>OMEGA NEWS</title>
    <?php require_once "head.php"; ?>   
</head>
<body>
<?php require_once "header.php"; ?> 


<?php
if(isset($_POST["enviar"])){
$usuario->actualizar_usuario($_POST["id"],$_POST["usuario"],$_POST["nombre"],$_POST["apellido1"],$_POST["apellido2"],$_POST["email"],$_POST["telefono"]);
}






require_once "class/usuarios.php";
$usuario = new usuario();
$id =  $usuario->get_usuario_id($_SESSION["usuario"]);
$datos = $usuario->get_usuario($id);
while($t_usuario = $datos[0]->fetch()){
    $usuario = $t_usuario["usuario"];
    $nombre = $t_usuario["nombre"];
    $apellido1 = $t_usuario["ape1"];
    $apellido2 = $t_usuario["ape2"];
    $email = $t_usuario["email"];
    $telefono = $t_usuario["telefono"];    
}
?>

<h2>¡Hola, <?php echo $_SESSION["usuario"]; ?>!</h2>
<br>
<p>
Aquí puedes modificar tus datos personales.
</p>
<br>
<form name="alta" class="" action="" method="post" onsubmit="return comprobar();">
        <input type="hidden" name="id" value='<?php echo $id; ?>'>
      <label for="nombre">Usuario*</label>
      <input type="text" required name="usuario" value='<?php echo $usuario; ?>'>      
      <label for="nombre">Nombre*</label>
      <input type="text" required name="nombre" value='<?php  echo $nombre; ?>' >
      <label for="apellido1">Primer Apellido*</label>
      <input type="text" required name="apellido1" value='<?php echo $apellido1; ?>' >
      <label for="apellido2">Segundo Apellido*</label>
      <input type="text" required name="apellido2" value='<?php echo $apellido2; ?>'>
      <label for="email">Email*</label>
      <input type="email" required name="email" value='<?php echo $email; ?>'>
      <label for="telefono">Teléfono*</label>
      <input type="text" required name="telefono" value='<?php echo $telefono; ?>'>
      <input type="submit" name='enviar' value="Guardar cambios">
    </form>


</body>
</html>