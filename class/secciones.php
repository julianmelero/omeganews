<?php

require_once "conexion.php";

$con = new conexion();

class secciones{

    function get_secciones(){      
        $con = new conexion();
        $sql = "SELECT * FROM secciones;";
        return $con->query($sql,array());      
      }



}



?>