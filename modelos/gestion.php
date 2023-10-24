<?php

	   //conexión a la base de datos

	   require_once("../config/conexion.php");

	   class Gestion extends Conectar{

          
       //método para seleccionar registros

   	   public function get_gestion(){

   	   	  $conectar=parent::conexion();
   	   	  parent::set_names();

   	   	  $sql="select * from gestion";

   	   	  $sql=$conectar->prepare($sql);
   	   	  $sql->execute();

   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }

  }


   ?>