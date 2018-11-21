<?php
/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/
require "conexion.php";

$con = new conexion();

class tipo_usuario{

  function get_tipos(){
    $con = new conexion();
    $query = "SELECT * FROM tipos_usuario;";
    return $resultado =$con->query($query, array());
  }

  function get_tipo_usuario($id){
    $con = new conexion();
    $query = "SELECT nombre_tipo FROM tipos_usuario WHERE id = ?;";
    $resultado =$con->query($query, array($id));
    while($usuarios = $resultado[0]->fetch()){
      return $usuarios["nombre_tipo"];
    }
  }

  function get_id_periodista(){
    $con = new conexion();
    $query = "SELECT * FROM tipos_usuario WHERE nombre_tipo='Periodista';";
    return $resultado =$con->query($query, array());
  }

}
