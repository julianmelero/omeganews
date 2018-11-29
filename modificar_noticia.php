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
require_once "class/secciones.php";
require_once "class/usuarios.php";
require_once "class/palabras_clave.php";
$secciones = new secciones();
$usuarios = new usuario();
$palabras_clave = new palabras_clave();
$id_usuario = $usuarios->get_usuario_id($_SESSION["usuario"]);
$hoy = date('Y-m-d');
require_once "class/publicacion.php";
$publicacion = new publicacion();

if (isset($_POST["guardar"])) {
    require_once "class/publicacion.php";
    $publicacion = new publicacion();                
    $resultado = $publicacion->update_publicacion($_POST["id_usuario"],$_POST["titulo"],$_POST["subtitulo"],    
    $_POST["id_seccion"],$_POST["fecha"],$_POST["texto_noticia"],$_POST["url_img"],$_POST["id"]);        
    
    $id_publicacion = $_POST["id"];
    $palabras =  explode(",",$_POST["palabra_clave"]);
    // Primero borro las palabras asociadas a la publicacion
    $palabras_clave->delete_palabra_publicacion($id_publicacion);
    foreach ($palabras as $valor) {
        $existe = $palabras_clave->existe_palabra($valor);     
        if ($existe==0) {
            $resultado_palabra = $palabras_clave->set_palabra($valor);
            $id_palabra = $resultado_palabra[1];           
            // Ahora insertamos las palabras de en la publicacion
            $palabras_clave->set_palabra_publicacion($id_publicacion,$id_palabra);
        }
        else{            
            // Ahora insertamos las palabras de en la publicacion
            $id_palabra = $palabras_clave->get_id_palabra($valor);
            $palabras_clave->set_palabra_publicacion($id_publicacion,$id_palabra);
        }
    }    
}

if (isset($_POST["aprobar"])) {
    require_once "class/publicacion.php";
    $publicacion = new publicacion();                
    $resultado = $publicacion->update_publicacion($_POST["id_usuario"],$_POST["titulo"],$_POST["subtitulo"],    
    $_POST["id_seccion"],$_POST["fecha"],$_POST["texto_noticia"],$_POST["url_img"],$_POST["id"]);        
    
    $id_publicacion = $_POST["id"];
    $palabras =  explode(",",$_POST["palabra_clave"]);
    // Primero borro las palabras asociadas a la publicacion
    $palabras_clave->delete_palabra_publicacion($id_publicacion);
    foreach ($palabras as $valor) {
        $existe = $palabras_clave->existe_palabra($valor);     
        if ($existe==0) {
            $resultado_palabra = $palabras_clave->set_palabra($valor);
            $id_palabra = $resultado_palabra[1];           
            // Ahora insertamos las palabras de en la publicacion
            $palabras_clave->set_palabra_publicacion($id_publicacion,$id_palabra);
        }
        else{            
            // Ahora insertamos las palabras de en la publicacion
            $id_palabra = $palabras_clave->get_id_palabra($valor);
            $palabras_clave->set_palabra_publicacion($id_publicacion,$id_palabra);
        }
    }
    $publicacion->aprobar($id_publicacion);    
}


$publi = $publicacion->get_publicacion($_POST["id"]);

while ($datos = $publi[0]->fetch()) {
    $id = $datos["id"];
    $titulo = $datos["titulo"];
    $subtitulo = $datos["subtitulo"];
    $id_usuario = $datos["id_usuario"];
    $id_seccion = $datos["id_seccion"];
    $fecha = $datos["fecha"];
    $texto_noticia = $datos["texto_noticia"];
    $url_img = $datos["url_img"];
    $aprobado = $datos["aprobado"];
}

// Cogemos las palabras de la publicación
$palabras_publicacion =  $palabras_clave->get_palabras_publicacion($_POST["id"]);
$palabra='';
while ($palabras = $palabras_publicacion[0]->fetch()) {
    // Por cada clave cogemos el nombre de palabras clave    
    $idpalabra = $palabras["id_palabra"];
    $aux = $palabras_clave->get_palabra($idpalabra);
    if ($palabra=='') {
        $palabra = $aux;    
    }else{
    $palabra = $palabra.",".$aux;
    }
}




?> 
<h1>Modificar Noticia</h1>
<form action="" method="post">
    <input type="hidden" name="id" id='id' value="<?php echo $id; ?>">  
    <input type="hidden" name="id_usuario" id='id_usuario' value="<?php echo $id_usuario; ?>">
    <label for="titulo">Título</label>
    <input type="text" maxlength="250" name="titulo" required maxlenght="250" value="<?php echo $titulo; ?>">
    <label for="subtitulo">Subtítulo</label>
    <input type="text" maxlength="250" name="subtitulo" required maxlenght="250" value="<?php echo $subtitulo; ?>">
    <label for="fecha">Fecha</label>
    <input type="date" name="fecha" value="<?php echo $fecha; ?>" required>
    <label for="palabra_clave">Palabras Clave (searado por comas)</label>
    <input type="text" maxlength="250" name="palabra_clave" required maxlenght="250" value="<?php echo $palabra; ?>" >
    <label for="seccion">Sección</label>
    <select name="id_seccion" id="seccion">
    <?php
    $datos = $secciones->get_secciones();
    
    while($seccion = $datos[0]->fetch()){        
        ?>        
        <option value="<?php echo $seccion["id"];?>" <?php if($seccion["id"]==$id_seccion){ echo "selected='true'"; } ?>" ><?php echo $seccion["nombre"]; ?></option>        
        <?php
    }

    ?>
    </select>
    <label for="texto_noticia">Texto</label>
    <textarea name="texto_noticia" id="" cols="45" rows="12" required><?php echo $texto_noticia; ?></textarea>
    <label for="url_img">Imagen</label>
    <input type="file" name="url_img" id="url_img" accept="image/png, image/jpeg">
    <input type="submit" name="guardar" value="Guardar Noticia">
    <input type="submit" name="aprobar" value="Guardar y Aprobar">
    
    



</form>



</body>
</html>