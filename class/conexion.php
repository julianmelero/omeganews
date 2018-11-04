/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez
*/

<?php
require "./credenciales.php";

class conexion{

public $mysql;
  function __construct(){
    try {
      $cadena = "mysql:host=".HOST.";dbname=".DB;
      $this->mysql = new PDO("$cadena",USER,PASS);
      $this->mysql->exec("SET CHARACTER SET utf8");
      $this->mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
      exit("No se pudo conectar: " . $e->getMessage());
    }
  }

  function query($sql,$args){
    $resultados = array();
    try{
      $consulta = $this->mysql->prepare($sql);
      if (empty($args)) {
          $consulta->execute();
      }
      else{
        $consulta->execute($args);
        $id = $this->mysql->lastInsertId();
        $resultados[1]= $id;
      }
      $resultados[0]= $consulta;
      return $resultados;
    }catch (PDOException $e){
      return 1;
    }
  }
}
 ?>
