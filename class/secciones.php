<?php

require "conexion.php";

$con = new conexion();

class secciones{

    function get_secciones(){      
        $con = new conexion();
        $sql = "SELECT * FROM usuarios;";
        return $con->query($sql,array());      
      }



}



?>