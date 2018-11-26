<?php

require_once "conexion.php";


class palabras_clave{

    function get_palabras_publicacion($id){      
        $con = new conexion();
        $sql = "SELECT * FROM palabras_clave_publicacion WHERE id_publicacion= ?;";
        return $con->query($sql,array($id));      
    }

    function set_palabra($palabra){      
        $con = new conexion();
        $palabra = strtolower($palabra);
        $sql = "INSERT INTO palabras_clave(nombre) VALUES(?);";
        return $con->query($sql,array($palabra));      
    }

    function set_palabra_publicacion($id_publicacion,$id_palabra){      
        $con = new conexion();        
        $sql = "INSERT INTO palabras_clave_publicacion(id_publicacion,id_palabra) VALUES(?,?);";
        return $con->query($sql,array($palabra));      
    }
    function existe_palabra($palabra){
        $palabra = strtolower($palabra);
        $con = new conexion();
        $sql = "SELECT * FROM palabras_clave WHERE palabra= ?;";
        $datos = $con->query($sql,array($palabra));  
        if($datos[0]->rowCount() >= 1){
            return 1;
          }
          else{
            return 0;
          }
    }

}




?>