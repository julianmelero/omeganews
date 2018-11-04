<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/
require_once "conexion.php";
require_once "tipos_usuario.php";


class usuario{

    function get_usuario($id){

    }

    function autenticacion($usuario,$pwd){

    }

    function existe($usuario){

    }
    function set_usuario($usuario, $pass, $ape1, $ape2,$email, $telefono){      
      $tipos = new tipo_usuario();
      $errores = 0;
      // Cuando se da de alta siempre será periodista
      $datos = $tipos->get_id_periodista();
      while($t_usuarios = $datos[0]->fetch()){
        $id_perdista = $t_usuarios["id"];
      }
      if (isnull($id_perdista)) {
        $errores +=1;
      }

      if ($errores>0) {
        die("Lo sentimos :( No se pudo dar de alta, contacte con Omega News");
      }

    }


}
