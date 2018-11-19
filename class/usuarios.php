<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/
require_once "tipos_usuarios.php";


class usuario{

  function get_usuario_id($usuario){    
      $con = new conexion();
      $sql = "SELECT * FROM usuarios WHERE usuario=? ;";
      $datos = $con->query($sql,array($usuario));
      while($t_usuario = $datos[0]->fetch()){
        return $t_usuario["id"];
      }      
  }


    function get_usuario($id){      
      $con = new conexion();
      $sql = "SELECT * FROM usuarios WHERE id=? ;";
      return $con->query($sql,array($id));      
    }
    function get_usuarios(){      
      $con = new conexion();
      $sql = "SELECT * FROM usuarios;";
      return $con->query($sql,array());      
    }

    function autenticacion($usuario,$pwd){

      // Convertimos la contraseña a SHA1 con ek hash
      $hash = "somosomega";
      $pass = $hash . $pwd;
      $pass = hash("SHA1",$pass);      
      $con = new conexion();
      $sql = "SELECT usuario FROM usuarios WHERE usuario = ? and pass=?;";
      $resultado = $con->query($sql,array($usuario,$pass));
      if($resultado[0]->rowCount() == 1){
        // Credenciales correctas
        $this->crear_sesion($usuario);                
        header("Location: ./index.php");
      }
      else{
        echo "Usuario o contraseña incorrectos.";
      }
    }

    function existe($usuario){
      $con = new conexion();
      $sql = "SELECT * FROM usuarios WHERE usuario=? ;";
      $datos = $con->query($sql,array($usuario));
      while($t_usuarios = $datos[0]->fetch()){
      if($datos[0]->rowCount() >= 1){
        return 1;
      }
      else{
        return 0;
      }
    }
  }



    function set_usuario($usuario,$nombre, $pass,$pass2, $ape1, $ape2,$email, $telefono){      
      $tipos = new tipo_usuario();
      $errores = 0;
      // Comprobamos los parámetros

      if (is_null($usuario) or is_null($pass) or is_null($pass2) or is_null($ape1) or is_null($ape2) or is_null($email) or is_null($telefono) ) {
        $errores += 1;
        $mensaje= "Algunos datos están incompletos o son incorrectos.";
      }
      $existe = $this->existe($usuario);
      if ($existe==1) {
        $errores += 1;
        $mensaje= "El usuario ya existe";
      }
      if($pass <> $pass2){        
        $errores += 1;
        $mensaje= "Las contraseñas no coinciden.";
      }

      // Cuando se da de alta siempre será periodista
      $datos = $tipos->get_id_periodista();
      while($t_usuarios = $datos[0]->fetch()){
        $id_periodista = $t_usuarios["id"];        
      }
      if ( !isset($id_periodista) or is_null($id_periodista)) {
        $errores +=1;
        $mensaje= "Lo sentimos :( ha habido un error inesperado.";
      }



      if ($errores>0) {
        echo($mensaje);
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
        if($con->query($query,array())){
          // Creamos las sessiones y vamos a index
          $this->crear_sesion($usuario);                        
          header("Location: ./index.php");
        }
        

        
      }

    }



    function actualizar_usuario($id,$usuario,$nombre,$ape1, $ape2,$email, $telefono){            
      $errores = 0;
      // Comprobamos los parámetros

      if (is_null($usuario) or is_null($ape1) or is_null($ape2) or is_null($email) or is_null($telefono) ) {
        $errores += 1;
        $mensaje= "Algunos datos están incompletos o son incorrectos.";
      }
      

      if ($errores>0) {
        echo($mensaje);
      }
      else{
        // Actualizamos en la BD

        $con = new conexion();
        $query = "UPDATE usuarios SET 
        usuario=?,
        nombre=?,
        ape1=?,
        ape2=?,
        email=?,
        telefono=?
        WHERE id=?";
        
        if($con->query($query,array($usuario,$nombre,$ape1,$ape2,$email,$telefono,$id))){
          echo "Se ha actualizado correctamente";
        }
        else{
          echo "Lo sentimos, ha habido un error al actualizar :(";
        }
      }
        

        
      }

    

    function tipo_usuario($usuario){
      $con = new conexion();
      $query = "SELECT id_tipo_usuario FROM usuarios WHERE usuario = ?;";
      $resultado = $con->query($query,array($_SESSION["usuario"]));
      while($datos = $resultado[0]->fetch()){
        $id_tipo_usuario = $datos["id_tipo_usuario"];
      }

      $query = "SELECT nombre_tipo FROM tipos_usuario WHERE id=?;";
      $resultado = $con->query($query,array($id_tipo_usuario));
      while($datos = $resultado[0]->fetch()){
         return $nombre_tipo_usuario = $datos["nombre_tipo"];
      }
    }

    function crear_sesion($usuario){
      session_start();
      $_SESSION["usuario"] = $usuario;
    }


}
