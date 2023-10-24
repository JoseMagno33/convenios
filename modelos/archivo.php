<?php

	   //conexión a la base de datos

	   require_once("../config/conexion.php");

	   class Archivo extends Conectar{


      public function get_filas_cliente(){

             $conectar= parent::conexion();
           
             $sql="select * from clientes";
             
             $sql=$conectar->prepare($sql);

             $sql->execute();

             $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

             return $sql->rowCount();
        
        }

           
       //método para seleccionar registros

   	   public function get_archivo(){

   	   	  $conectar=parent::conexion();
   	   	  parent::set_names();

   	   	  $sql="SELECT a.id_archivo, p.pais as id_pais ,a.nombre_archivo, a.descripcion, a.ubicacion, a.tipo, a.tipov
          FROM archivo a 
          inner JOIN pais p on p.id_pais = a.id_pais";

   	   	  $sql=$conectar->prepare($sql);
   	   	  $sql->execute();

   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }


            /*poner la ruta vistas/upload*/
              public function upload_archivo() {

                if(isset($_FILES["nombre_archivo"]))
                {
                  $extension = explode('.', $_FILES['nombre_archivo']['name']);
                  $new_name = rand() . '.' . $extension[1];
                  $destination = '../vistas/upload/' . $new_name;
                  move_uploaded_file($_FILES['nombre_archivo']['tmp_name'], $destination);
                  return $new_name;
                }
    
    
              }

   	     //método para insertar registros

        public function registrar_archivo($id_pais,$descripcion,$tipov,$nombre_archivo,$id_usuario){

           
           $conectar= parent::conexion();
           parent::set_names();


           require_once("archivo.php");


           $archivopdf = new Archivo();

                 
           $arch = '';
           if($_FILES["nombre_archivo"]["name"] != '')
           {
             $arch = $archivopdf->upload_archivo();
           }


           $sql="insert into archivo (id_pais, descripcion, tipov, nombre_archivo, id_usuario)
           values(?,?,?,?,?);";
         
            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $_POST["id_pais"]);
            $sql->bindValue(2, $_POST["descripcion"]);
            $sql->bindValue(3, $_POST["tipov"]);
            $sql->bindValue(4, $arch);
            $sql->bindValue(5, $_POST["id_usuario"]);
            $sql->execute();
      
         
        }

    //método para editar un registro
       
    public function editar_archivo($id_archivo,$id_pais,$descripcion,$tipov,$nombre_archivo,$id_usuario){

      $conectar= parent::conexion();
      parent::set_names();


      require_once("archivo.php");


      $archivopdf = new Archivo();

            
      $arch = '';
          if($_FILES["nombre_archivo"]["name"] != '')
          {
            $arch = $archivopdf->upload_archivo();
          }


          $sql="update archivo set 
                       id_pais=?,
                       descripcion=?,
                       tipov=?,
                       nombre_archivo=?,
                       id_usuario=?
                       where 
                       id_archivo=?
                ";
        
          $sql=$conectar->prepare($sql);

          $sql->bindValue(1, $_POST["id_pais"]);
          $sql->bindValue(2, $_POST["descripcion"]);
          $sql->bindValue(3, $_POST["tipov"]);
          $sql->bindValue(4, $arch);
          $sql->bindValue(5, $_POST["id_usuario"]);
          $sql->bindValue(6, $_POST["id_archivo"]);          
          $sql->execute();
 

   }


         //método para mostrar los datos de un registro a modificar
        public function get_archivo_por_id($id_archivo){
            
            $conectar= parent::conexion();
            parent::set_names();

            $sql="select * from archivo where id_archivo=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_archivo);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
      
        public function get_archivo_por_pais_tipov($id_pais,$tipov){
            
          $conectar= parent::conexion();
          parent::set_names();

          $sql="select * from archivo where id_pais=? and tipov like ?";

          $sql=$conectar->prepare($sql);

          $sql->bindValue(1, $_POST["id_pais"]);
          $sql->bindValue(2, $_POST["tipov"]);
          $sql->execute();
          return $resultado=$sql->fetchAll();
      }
        


  }


   ?>