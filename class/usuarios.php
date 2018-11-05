<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/
require_once "tipos_usuarios.php";


class usuario{

    function get_usuario($id){

    }

    function autenticacion($usuario,$pwd){

    }

    function existe($usuario){

    }
    function set_usuario($usuario,$nombre, $pass, $ape1, $ape2,$email, $telefono){      
      $tipos = new tipo_usuario();
      $errores = 0;
      // Comprobamos los parámetros

      if (is_null($usuario) or is_null($pass) or is_null($ape1) or is_null($ape2) or is_null($email) or is_null($telefono) ) {
        die("Lo sentimos :( No se pudo dar de alta, contacte con Omega News. <a href='index.php'>Volver</a> ");
      }      

      // Cuando se da de alta siempre será periodista
      $datos = $tipos->get_id_periodista();
      while($t_usuarios = $datos[0]->fetch()){
        $id_periodista = $t_usuarios["id"];        
      }
      if ( !isset($id_periodista) or is_null($id_periodista)) {
        $errores +=1;
      }



      if ($errores>0) {
        die("Lo sentimos :( No se pudo dar de alta, contacte con Omega News. <a href='index.php'>Volver</a>");
      }
      else{
        // Insertamos en la BD

        // Ciframos la contraseña con un Hash y SHA1
        $hash = "somosomega";
        $pass = $hash . $pass;
        $pass = hash("SHA1",$pass);

        $con = new conexion();
        $query = "INSERT INTO usuarios (usuario,nombre,pass,ape1,ape2,id_tipo_usuario,email,telefono)
        VALUES('$usuario','$nombre','$pass','$ape1','$ape2',$id_periodista,'$email','$telefono');";
        echo $query;
        $con->query($query,array());
        
      }

    }


}
