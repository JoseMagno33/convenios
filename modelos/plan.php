<?php

	   //conexión a la base de datos

	   require_once("../config/conexion.php");

	   class Plan extends Conectar{


      public function get_filas_plan(){

             $conectar= parent::conexion();
           
             $sql="select * from cmx_plan";
             
             $sql=$conectar->prepare($sql);

             $sql->execute();

             $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

             return $sql->rowCount();
        
        }

           
       //método para seleccionar registros

   	   public function get_plan(){

   	   	  $conectar=parent::conexion();
   	   	  parent::set_names();

   	   	  $sql="select * from cmx_plan";

   	   	  $sql=$conectar->prepare($sql);
   	   	  $sql->execute();

   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }


   	     //método para insertar registros

        public function registrar_plan($tema, $id_usuario){

           
           $conectar= parent::conexion();
           parent::set_names();

           $sql="insert into plan (tema,id_usuario)
           values(?,?,?);";
         
            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $_POST["pais"]);
            $sql->bindValue(2, $_POST["abrev"]);
            $sql->execute();
      
         
        }

    //método para editar un registro
       
    public function editar_plan($id_pais,$pais,$abrev,$id_usuario){

      $conectar=parent::conexion();
      parent::set_names();

       require_once("plan.php");

       $pais = new Pais();

           $sql="update plan set 
              pais=?,
              abrev=?,
              where 
              id_pais=?

           ";
           

                 $sql=$conectar->prepare($sql);

                 $sql->bindValue(1, $_POST["pais"]);
                 $sql->bindValue(2, $_POST["abrev"]);
                 $sql->bindValue(3, $_POST["id_pais"]);
                 $sql->execute();

   }


         //método para mostrar los datos de un registro a modificar
        public function get_plan_por_id($id_pais){

            
            $conectar= parent::conexion();
            parent::set_names();

            $sql="select * from plan where id_pais=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_pais);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

  

  }


   ?>