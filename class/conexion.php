/*
Copyright (C) 2018  Julián Melero Hidalgo, Araceli Garrido García, Alfredo Oleagagoitia Álvarez

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.

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
