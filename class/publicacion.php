<?php
require_once "conexion.php";


class publicacion{

    function get_publicaciones(){      
        $con = new conexion();
        $sql = "SELECT * FROM publicaciones WHERE aprobado=1;";
        return $con->query($sql,array());      
      }

    function get_publicacion($id){      
        $con = new conexion();
        $sql = "SELECT * FROM publicaciones
        WHERE id=?;";
        return $con->query($sql,array($id));      
      }

    function get_publicaciones_no_aprobadas(){
      $con = new conexion();
      $sql = "SELECT * FROM publicaciones WHERE aprobado=0 order by fecha ASC;";
      return $con->query($sql,array());    
    }  

    function create_publicacion($id_usuario,$titulo,$subtitulo,$id_seccion,$fecha,$texto_noticia,$url_img){
      $con = new conexion();
      $sql = "INSERT INTO publicaciones(id_usuario,titulo,subtitulo,id_seccion,fecha,texto_noticia,url_img)
      VALUES(?,?,?,?,?,?,?);";
      return $con->query($sql,array($id_usuario,$titulo,$subtitulo,$id_seccion,$fecha,$texto_noticia,$url_img));      

    }

    function update_publicacion($id_usuario,$titulo,$subtitulo,$id_seccion,$fecha,$texto_noticia,$url_img,$id){
      $con = new conexion();      
      $sql = "UPDATE publicaciones 
      SET id_usuario= ?,titulo = ?,subtitulo= ?,id_seccion= ?,fecha= ?,texto_noticia= ?,url_img= ? 
      WHERE id= ?;";      
      return $con->query($sql,array($id_usuario,$titulo,$subtitulo,$id_seccion,$fecha,$texto_noticia,$url_img,$id));      

    }

    function aprobar($id){
      $con = new conexion();      
      $sql = "UPDATE publicaciones 
      SET aprobado=1
      WHERE id= ?;";      
      return $con->query($sql,array($id));      
    }
    
    
    function tipo_seccion($id){
       $con= new conexion();
       $sql= "SELECT * FROM publicaciones WHERE publicaciones.id_seccion= ? AND aprobado=1;";
       return $con->query($sql,array($id)); 
    }
}


?>