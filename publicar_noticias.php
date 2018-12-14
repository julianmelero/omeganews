<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OMEGA NEWS</title>
    <?php require_once "head.php"; ?>  
</head>
<body>
<?php require_once "header.php";
if(!isset($_SESSION["usuario"])){
    header('Location: index.php');
}
require_once "class/secciones.php";
require_once "class/usuarios.php";
require_once "class/palabras_clave.php";
$secciones = new secciones();
$usuarios = new usuario();
$palabras_clave = new palabras_clave();
$id_usuario = $usuarios->get_usuario_id($_SESSION["usuario"]);
$hoy = date('Y-m-d');


if (isset($_POST["guardar"])) {
    require_once "class/publicacion.php";
    $publicacion = new publicacion();
    $resultado = $publicacion->create_publicacion($id_usuario,$_POST["titulo"],$_POST["subtitulo"],
    $_POST["id_seccion"],$_POST["fecha"],$_POST["texto_noticia"],$_FILES['imagen']['name']);
    $id_publicacion = $resultado[1];

    $palabras =  explode(",",$_POST["palabra_clave"]);
    foreach ($palabras as $valor) {
        $existe = $palabras_clave->existe_palabra($valor);
        if ($existe==0) {
            $resultado_palabra = $palabras_clave->set_palabra($valor);
            $id_palabra = $resultado_palabra[1];
            $palabras_clave->set_palabra_publicacion($id_publicacion,$id_palabra);
        }
        else{
            $id_palabra = $palabras_clave->get_id_palabra($valor);
            $palabras_clave->set_palabra_publicacion($id_publicacion,$id_palabra);
        }
    }


    // Subimos la imagen
    if (!is_dir("img_noticias/".$id_publicacion)) {
        mkdir("img_noticias/".$id_publicacion);
    }
    $dir_subida = 'img_noticias/'.$id_publicacion."/";
    $fichero_subido = $dir_subida . basename($_FILES['imagen']['name']);        
    move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido);
}

?> 
<h1>Nueva Noticia</h1>
<form enctype="multipart/form-data" action="publicar_noticias.php" method="post">
    <input type="hidden" name="id_usuario" value='<?php echo $id_usuario; ?>'>
    <label for="titulo">Título</label>
    <input type="text" maxlength="250" name="titulo" required maxlenght="250">
    <label for="subtitulo">Subtítulo</label>
    <input type="text" maxlength="250" name="subtitulo" required maxlenght="250">
    <label for="fecha">Fecha</label>
    <input type="date" name="fecha" value="<?php echo $hoy; ?>" required>
    <label for="palabra_clave">Palabras Clave (searado por comas)</label>
    <input type="text" maxlength="250" name="palabra_clave" required maxlenght="250">
    <label for="seccion">Sección</label>
    <select name="id_seccion" id="seccion">
    <?php
    $datos = $secciones->get_secciones();
    
    while($seccion = $datos[0]->fetch()){        
        ?>        
        <option value="<?php echo $seccion["id"]; ?>" ><?php echo $seccion["nombre"]; ?></option>        
        <?php
    }

    ?>
    </select>
    <label for="texto_noticia">Texto</label>
    <textarea name="texto_noticia" id="texto_noticia" cols="45" rows="12" ></textarea>
    <label for="imagen">Imagen</label>
    <input type="file" name="imagen" id="imagen" accept="image/png, image/jpeg">
    <input type="submit" name="guardar" value="Guardar Noticia">

</form>

<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
						
</body>
</html>