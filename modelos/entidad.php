<?php

	   //conexión a la base de datos

	   require_once("../config/conexion.php");

	   class Entidad extends Conectar{

       //método para seleccionar registros

   	   public function get_entidad(){

   	   	  $conectar=parent::conexion();
   	   	  parent::set_names();

   	   	  $sql="SELECT * FROM cmx_entidad";

   	   	  $sql=$conectar->prepare($sql);
   	   	  $sql->execute();

   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }

	    public function get_entidad_padre(){

			$conectar=parent::conexion();
			parent::set_names();

			$sql="SELECT * FROM cmx_entidad 
					where id_padre = 0";

			$sql=$conectar->prepare($sql);
			$sql->execute();

			return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
	  }

		  
  }


   ?>