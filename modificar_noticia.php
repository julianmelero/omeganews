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
    if($_FILES["imagen"]["size"]==0){
        $publi = $publicacion->get_publicacion($_POST["id"]);
        while ($datos = $publi[0]->fetch()) {            
            $url_img = $datos["url_img"];            
        }  
        $_FILES["imagen"]['name'] = $url_img;
    }
    $resultado = $publicacion->update_publicacion($_POST["id_usuario"],$_POST["titulo"],$_POST["subtitulo"],    
    $_POST["id_seccion"],$_POST["fecha"],$_POST["texto_noticia"],$_FILES["imagen"]['name'],$_POST["id"]);        
    
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
    // Subimos la imagen    
    if($_FILES["imagen"]["size"]>0){        
        if (!is_dir("img_noticias/".$id_publicacion)) {
            mkdir("img_noticias/".$id_publicacion);
        }
        $dir_subida = 'img_noticias/'.$id_publicacion."/";
        $fichero_subido = $dir_subida . basename($_FILES['imagen']['name']);        
        move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido);
    }
}    


if (isset($_POST["aprobar"])) {
    require_once "class/publicacion.php";
    $publicacion = new publicacion(); 
    if($_FILES["imagen"]["size"]==0){
        $publi = $publicacion->get_publicacion($_POST["id"]);
        while ($datos = $publi[0]->fetch()) {            
            $url_img = $datos["url_img"];            
        }  
        $_FILES["imagen"]['name'] = $url_img;
    }               
    $resultado = $publicacion->update_publicacion($_POST["id_usuario"],$_POST["titulo"],$_POST["subtitulo"],    
    $_POST["id_seccion"],$_POST["fecha"],$_POST["texto_noticia"],$_FILES["imagen"]["name"],$_POST["id"]);        
    
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
    if($_FILES["imagen"]["name"]!=''){
        if (!is_dir("img_noticias/".$id_publicacion)) {
            mkdir("img_noticias/".$id_publicacion);
        }
        $dir_subida = 'img_noticias/'.$id_publicacion."/";
        $fichero_subido = $dir_subida . basename($_FILES['imagen']['name']);        
        move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido);
        $publicacion->aprobar($id_publicacion);    
    }
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


$dir = "img_noticias/".$id."/".$url_img;
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
<form  enctype="multipart/form-data" action="" method="post">
    <input type="hidden" name="id" id='id' value="<?php echo $id; ?>">  
    <input type="hidden" name="id_usuario" id='id_usuario' value="<?php echo $id_usuario; ?>">
    <label for="autor">Autor</label>
    <?php
     $d_usuario = $usuarios->get_usuario($id_usuario);
     while ($usuario = $d_usuario[0]->fetch()) {?>
       <input type="text" maxlength="250" name="autor" readonly maxlenght="250" value="<?php echo $usuario["nombre"]." ".$usuario["ape1"]." ".$usuario["ape2"]; ?>">
     <?php      
     }
    ?>
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
    <textarea name="texto_noticia" id="texto_noticia" cols="45" rows="12" required><?php echo $texto_noticia; ?></textarea>
    <label for="url_img">Imagen</label>
    <input type="file" name="imagen" id="imagen" accept="image/png, image/jpeg">
    <img src="<?php echo $dir; ?>" alt="" width='250px' heigth='200px'>
    <input type="submit" name="guardar" value="Guardar Noticia">
    <input type="submit" name="aprobar" value="Guardar y Aprobar">
        
</form>

<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
						
</body>
</html>