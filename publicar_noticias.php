<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OMEGA NEWS</title>
    <?php require_once "head.php"; ?>  
</head>
<body>
<?php require_once "header.php";

$hoy = date('Y-m-d');


if (isset($_POST["guardar"])) {
    echo "Enviado";
}







?> 
<h1>Nueva Noticia</h1>
<form action="" method="post">
    <input type="hidden" name="id_usuario" value='<?php  ?>'>
    <label for="titulo">Título</label>
    <input type="text" maxlength="250" name="titulo" required maxlenght="250">
    <label for="subtitulo">Subtítulo</label>
    <input type="text" maxlength="250" name="subtitulo" required maxlenght="250">
    <label for="fecha">Fecha</label>
    <input type="date" name="fecha" value="<?php echo $hoy; ?>" required>
    <label for="texto_noticia">Texto</label>
    <textarea name="texto_noticia" id="" cols="45" rows="12" required></textarea>
    <label for="url_img">Imagen</label>
    <input type="file" name="url_img" id="url_img" accept="image/png, image/jpeg">
    <input type="submit" name="guardar" value="Guardar Noticia">
    
    



</form>



</body>
</html>