<?php

	   //conexión a la base de datos

	   require_once("../config/conexion.php");

	   class Pais extends Conectar{


      public function get_filas_cliente(){

             $conectar= parent::conexion();
           
             $sql="select * from clientes";
             
             $sql=$conectar->prepare($sql);

             $sql->execute();

             $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

             return $sql->rowCount();
        
        }

           
       //método para seleccionar registros

   	   public function get_pais(){

   	   	  $conectar=parent::conexion();
   	   	  parent::set_names();

   	   	  $sql="select * from pais";

   	   	  $sql=$conectar->prepare($sql);
   	   	  $sql->execute();

   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }


   	     //método para insertar registros

        public function registrar_pais($pais,$abrev,$id_usuario){

           
           $conectar= parent::conexion();
           parent::set_names();

           $sql="insert into pais (pais,abrev,id_usuario)
           values(?,?,?);";
         
            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $_POST["pais"]);
            $sql->bindValue(2, $_POST["abrev"]);
            $sql->bindValue(3, $_POST["id_usuario"]);
            $sql->execute();
      
         
        }

    //método para editar un registro
       
    public function editar_pais($id_pais,$pais,$abrev,$id_usuario){

      $conectar=parent::conexion();
      parent::set_names();

       require_once("pais.php");

       $pais = new Pais();

           $sql="update pais set 
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
        public function get_pais_por_id($id_pais){

            
            $conectar= parent::conexion();
            parent::set_names();

            $sql="select * from pais where id_pais=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_pais);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

         //este metodo es para validar el id del cliente(luego llamamos el metodo de editar_estado()) 
        //el id_cliente se envia por ajax cuando se editar el boton cambiar estado y que se ejecuta el evento onclick y llama la funcion de javascript
        public function get_cliente_por_id($id_cliente){

          $conectar= parent::conexion();

          //$output = array();

          $sql="select * from clientes where id_cliente=?";

                $sql=$conectar->prepare($sql);

                $sql->bindValue(1, $id_cliente);
                $sql->execute();

                return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


        } 

     


        /*metodo que valida si hay registros activos*/
        public function get_cliente_por_id_estado($id_cliente,$estado){

         $conectar= parent::conexion();

         //declaramos que el estado esté activo, igual a 1

         $estado=1;

          
        $sql="select * from clientes where id_cliente=? and estado=?";

              $sql=$conectar->prepare($sql);

              $sql->bindValue(1, $id_cliente);
               $sql->bindValue(2, $estado);
              $sql->execute();

              return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


         }


          //método para activar Y/0 desactivar el estado del cliente

        public function editar_estado($id_cliente,$estado){

        	 $conectar=parent::conexion();

        	 //si el estado es igual a 0 entonces el estado cambia a 1
        	 //el parametro est se envia por via ajax
        	 if($_POST["est"]=="0"){

        	   $estado=1;

        	 } else {

        	 	 $estado=0;
        	 }

        	 $sql="update clientes set 
              
              estado=?
              where 
              id_cliente=?

        	 ";

        	 $sql=$conectar->prepare($sql);

        	 $sql->bindValue(1,$estado);
        	 $sql->bindValue(2,$id_cliente);
        	 $sql->execute();
        }

         //método si el cliente existe en la base de datos
        //valida si existe la cedula, cliente o correo, si existe entonces se hace el registro del cliente
        public function get_datos_cliente($cedula,$cliente,$correo){

           $conectar=parent::conexion();

           $sql= "select * from clientes where cedula_cliente=? or nombre_cliente=? or correo_cliente=?";

	        $sql=$conectar->prepare($sql);

	        $sql->bindValue(1, $cedula);
	        $sql->bindValue(2, $cliente);
	        $sql->bindValue(3, $correo);
	        $sql->execute();

           //print_r($email); exit();

           return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        
         public function eliminar_cliente($id_cliente){

                $conectar=parent::conexion();

                $sql="delete from clientes where id_cliente=?";

                $sql=$conectar->prepare($sql);

                $sql->bindValue(1, $id_cliente);
                $sql->execute();

                return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }


         public function get_cliente_por_id_usuario($id_usuario){

           $conectar= parent::conexion();

 
           $sql="select * from clientes where id_usuario=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_usuario);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


      }


         //consulta si la cedula del cliente con tiene un detalle_venta asociado
    public function get_cliente_por_cedula_ventas($cedula_cliente){

             
             $conectar=parent::conexion();
             parent::set_names();


             $sql="select c.cedula_cliente,v.cedula_cliente
                 
              from clientes c 
              
              INNER JOIN ventas v ON c.cedula_cliente=v.cedula_cliente


              where c.cedula_cliente=?

              ";

             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,$cedula_cliente);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

        }



        //consulta si el id del cliente tiene un detalle_venta asociado
        


  }


   ?>