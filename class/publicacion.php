<?php
require_once "conexion.php";


class publicacion{

    function get_publicaciones(){      
        $con = new conexion();
        $sql = "SELECT * FROM usuarios;";
        return $con->query($sql,array());      
      }

    function get_publicacion($id){      
        $con = new conexion();
        $sql = "SELECT * FROM publicaciones
        WHERE id=?;";
        return $con->query($sql,array($id));      
      }

    function create_publicacion($id_usuario,$titulo,$subtitulo,$id_seccion,$fecha,$texto_noticia,$url_img){
      $con = new conexion();
      $sql = "INSERT INTO publicaciones(id_usuario,titulo,subtitulo,id_seccion,fecha,texto_noticia,url_img)
      VALUES(?,?,?,?,?,?,?);";
      return $con->query($sql,array($id_usuario,$titulo,$subtitulo,$id_seccion,$fecha,$texto_noticia,$url_img));      

    }

}


?>