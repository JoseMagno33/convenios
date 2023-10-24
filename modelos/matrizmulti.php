<?php

	   //conexión a la base de datos

	   require_once("../config/conexion.php");

	   class MatrizMulti extends Conectar{


           
       //método para seleccionar registros

   	   public function get_matriz(){

   	   	  $conectar=parent::conexion();
   	   	  parent::set_names();

   	   	  $sql="SELECT m.id_matriz,  if(m.subgrupo=null,'0','1') as subgrupo, if(m.nro_compromiso=null,0,1) as nro_compromiso, ct.tema as id_tema, m.id_entidad, p.pais as id_pais, m.compromiso, 
            m.entidad_responsable, m.contacto, m.fecha_cumplimiento, m.observaciones, 
            est.estado_cumplimiento,m.fecha_actualizacion, m.id_usuario 
            FROM cmx_tema ct 
            inner JOIN cmx_matriz m on ct.id_tema = m.id_tema 
            inner join cmx_estado est on est.id_estado_cumplimiento = m.estado_cumplimiento
            inner join pais p on m.id_pais = p.id_pais
            order by m.nro_compromiso";

   	   	  $sql=$conectar->prepare($sql);
   	   	  $sql->execute();

   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }

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

        public function registrar_multilateral($descripcion,$id_entidad,$nombre_archivo,$fecha,$id_usuario){

           
           $conectar= parent::conexion();
           parent::set_names();

           require_once("matrizmulti.php");


           $matmulti = new MatrizMulti();


           $arch = '';
           if($_FILES["nombre_archivo"]["name"] != '')
           {
             $arch = $matmulti->upload_archivo();
           }


           $sql="insert into cmx_multilateral (descripcion,id_entidad, nombre_archivo, fecha,id_usuario)
           values(?,?,?,?,?)";
         
            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $_POST["descripcion"]);
            $sql->bindValue(2, $_POST["id_entidad"]);
            $sql->bindValue(3, $arch);            
            $sql->bindValue(4, $_POST["fecha"]);
            $sql->bindValue(5, $_POST["id_usuario"]);
            
            $sql->execute();
      
         
        }

    //método para editar un registro
       
    public function editar_multilateral($id_multilateral,$descripcion,$id_entidad,$nombre_archivo,$fecha,$id_usuario){

      $conectar=parent::conexion();
      parent::set_names();
      require_once("matrizmulti.php");


      $matmulti = new MatrizMulti();
            
      $arch = '';
          if($_FILES["nombre_archivo"]["name"] != '')
          {
            $arch = $matmulti->upload_archivo();
          }


          $sql="update cmx_multilateral set 
                       descripcion=?,
                       id_entidad=?,                       
                       nombre_archivo=?,
                       fecha=?,                       
                       id_usuario=?
                       where 
                       id_multilateral=?
                ";
        
          $sql=$conectar->prepare($sql);

          $sql->bindValue(1, $_POST["descripcion"]);
          $sql->bindValue(2, $_POST["id_entidad"]);
          $sql->bindValue(3, $arch);
          $sql->bindValue(4, $_POST["fecha"]);
          $sql->bindValue(5, $_POST["id_usuario"]);
          $sql->bindValue(6, $_POST["id_multilateral"]);          
          $sql->execute();

   }


         //método para mostrar los datos de un registro a modificar
        public function get_matriz_por_id($id_matriz){

            
            $conectar= parent::conexion();
            parent::set_names();

            $sql="select * from cmx_matriz where id_matriz=? order by nro_compromiso";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_matriz);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    

        
        public function eliminar_matriz($id_matriz){

          $conectar=parent::conexion();

          $sql="delete from cmx_matriz where id_matriz=?";

          $sql=$conectar->prepare($sql);

          $sql->bindValue(1, $id_matriz);
          $sql->execute();

          return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
  }


          public function get_entidad_padre(){

          $conectar=parent::conexion();
          parent::set_names();

          $sql=" SELECT * FROM cmx_entidad 
              where id_padre = 0
              and tipo_entidad like 'multilateral' ";

          $sql=$conectar->prepare($sql);
          $sql->execute();

          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function buscar_hijo($id_entidad){
           
          $conectar= parent::conexion();
          parent::set_names();

          $sql="SELECT cm.id_multilateral, cm.descripcion, ce.nombre_entidad as id_entidad, cm.nombre_archivo, 
                cm.fecha, cm.fecha_actualizacion
                from cmx_multilateral cm
                join cmx_entidad ce on ce.id_entidad = cm.id_entidad
                where ce.id_padre = ? or ce.id_entidad = ? ";
        
           $sql=$conectar->prepare($sql);

           $sql->bindValue(1, $id_entidad);
           $sql->bindValue(2, $id_entidad);
           
                  
           $sql->execute();
           return $resultado=$sql->fetchAll();
        
       }
       public function get_componente($id_entidad){
           
        $conectar= parent::conexion();
      
        $sql="select * from cmx_entidad where id_padre=?";
      
         $sql=$conectar->prepare($sql);
         $sql->bindValue(1, $id_entidad);                
         $sql->execute();
         return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
      
     }
     public function get_multilateral_por_id($id_multilateral){

            
      $conectar= parent::conexion();
      parent::set_names();

      $sql="select * from cmx_multilateral where id_multilateral=? order by descripcion";

      $sql=$conectar->prepare($sql);

      $sql->bindValue(1, $id_multilateral);
      $sql->execute();
      return $resultado=$sql->fetchAll();
  }

  public function get_entidades_m(){

      $conectar=parent::conexion();
      parent::set_names();

      $sql=" SELECT * FROM cmx_entidad 
          where tipo_entidad like 'multilateral' ";

      $sql=$conectar->prepare($sql);
      $sql->execute();

      return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

  }


   ?>