<?php

	   //conexión a la base de datos

	   require_once("../config/conexion.php");

	   class Matriz extends Conectar{


           
       //método para seleccionar registros

   	   public function get_matriz(){

   	   	  $conectar=parent::conexion();
   	   	  parent::set_names();

   	   	  $sql="SELECT m.id_matriz,  if(m.subgrupo=null,'0','1') as subgrupo, if(m.nro_compromiso=null,0,1) as nro_compromiso, ct.tema as id_tema, m.id_entidad, p.pais as id_pais, m.compromiso, 
            m.entidad_responsable, m.entidad_responsable_2, m.contacto, m.fecha_cumplimiento, m.observaciones, 
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


   	     //método para insertar registros

        public function registrar_matriz($id_tema,$subgrupo,$nro_compromiso,$compromiso,$entidad_responsable,$entidad_responsable_2,$contacto,$fecha_cumplimiento,$observaciones,$estado_cumplimiento,$id_usuario,$id_pais){

           
           $conectar= parent::conexion();
           parent::set_names();

           $sql="insert into cmx_matriz (id_tema,subgrupo, nro_compromiso, compromiso,entidad_responsable, entidad_responsable_2, contacto,fecha_cumplimiento,observaciones,estado_cumplimiento,id_usuario, id_pais)
           values(?,?,?,?,?,?,?,?,?,?,?,?);";
         
            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $_POST["id_tema"]);
            $sql->bindValue(2, $_POST["subgrupo"]);
            $sql->bindValue(3, $_POST["nro_compromiso"]);            
            $sql->bindValue(4, $_POST["compromiso"]);
            $sql->bindValue(5, $_POST["entidad_responsable"]);
            $sql->bindValue(6, $_POST["entidad_responsable_2"]);
            $sql->bindValue(7, $_POST["contacto"]);
            $sql->bindValue(8, $_POST["fecha_cumplimiento"]);
            $sql->bindValue(9, $_POST["observaciones"]);
            $sql->bindValue(10, $_POST["estado_cumplimiento"]);
            $sql->bindValue(11, $_POST["id_usuario"]);
            $sql->bindValue(12, $_POST["id_pais"]);
            
            $sql->execute();
      
         
        }

    //método para editar un registro
       
    public function editar_matriz($id_matriz,$id_tema,$subgrupo,$nro_compromiso,$compromiso,$entidad_responsable,$entidad_responsable_2,$contacto,$fecha_cumplimiento,$observaciones,$estado_cumplimiento,$id_usuario,$id_pais){

      $conectar=parent::conexion();
      parent::set_names();

       require_once("matriz.php");

       $matriz = new Matriz();

         //verifica si esta registrado por id matriz
         //$matriz_exist=$matrix->get_cliente_por_cedula_ventas($_POST["cedula_cliente"]);

     //verifica si la cedula tiene registro asociado a detalle_ventas
    // $cliente_detalle_ventas=$cliente->get_cliente_por_cedula_detalle_ventas($_POST["cedula_cliente"]);

      //si la cedula del cliente NO tiene registros asociados en las tablas ventas y detalle_ventas entonces se puede editar el cliente completo
  

           $sql="update cmx_matriz set 

              id_tema=?,
              subgrupo=?,
              nro_compromiso=?,
              compromiso=?,
              entidad_responsable=?,
              entidad_responsable_2=?,              
              contacto=?,
              fecha_cumplimiento=?,
              observaciones=?,
              estado_cumplimiento=?,
              id_usuario=?,
              id_pais=?
              where 
              id_matriz=?

           ";
           

                 $sql=$conectar->prepare($sql);

                 $sql->bindValue(1, $_POST["id_tema"]);
                 $sql->bindValue(2, $_POST["subgrupo"]);
                 $sql->bindValue(3, $_POST["nro_compromiso"]);                 
                 $sql->bindValue(4, $_POST["compromiso"]);
                 $sql->bindValue(5, $_POST["entidad_responsable"]);
                 $sql->bindValue(6, $_POST["entidad_responsable_2"]);
                 $sql->bindValue(7, $_POST["contacto"]);
                 $sql->bindValue(8, $_POST["fecha_cumplimiento"]);
                 $sql->bindValue(9, $_POST["observaciones"]);
                 $sql->bindValue(10, $_POST["estado_cumplimiento"]);
                 $sql->bindValue(11, $_POST["id_usuario"]);
                 $sql->bindValue(12, $_POST["id_pais"]);
                 $sql->bindValue(13, $_POST["id_matriz"]);
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

        public function get_pais($id_pais){

            
          $conectar= parent::conexion();
          parent::set_names();

          $sql="select * from pais where id_pais=?";

          $sql=$conectar->prepare($sql);

          $sql->bindValue(1, $id_pais);
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



        //consulta si el id del cliente tiene un detalle_venta asociado
         //método para mostrar los datos de un registro a modificar
      public function get_matriz_por_id_pais($id_pais,$id_usu){
 
          $conectar=parent::conexion();
         // parent::set_names();

          $sql="SELECT m.id_matriz, m.subgrupo, m.nro_compromiso, ct.tema as id_tema, m.id_entidad, p.pais as id_pais, m.compromiso, 
          m.entidad_responsable, m.entidad_responsable_2, m.contacto, m.fecha_cumplimiento, m.observaciones, 
          est.estado_cumplimiento,m.fecha_actualizacion, m.id_usuario 
          FROM cmx_tema ct 
          inner JOIN cmx_matriz m on ct.id_tema = m.id_tema 
          inner join cmx_estado est on est.id_estado_cumplimiento = m.estado_cumplimiento
          inner join pais p on m.id_pais = p.id_pais
          where m.id_pais = ?
          order by m.nro_compromiso";

          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $id_pais);
          
          $sql->execute();

          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

        }
        
        public function get_comixta_by_id_plan($id_plan){
 
          $conectar=parent::conexion();
         // parent::set_names();

          $sql="SELECT m.id_matriz, m.subgrupo, m.nro_compromiso, ct.tema as id_tema, m.id_entidad, p.pais as id_pais, m.compromiso, 
          m.entidad_responsable, m.entidad_responsable_2, m.contacto, m.fecha_cumplimiento, m.observaciones, 
          est.estado_cumplimiento,m.fecha_actualizacion, m.id_usuario 
          FROM cmx_tema ct 
          inner JOIN cmx_matriz m on ct.id_tema = m.id_tema 
          inner join cmx_estado est on est.id_estado_cumplimiento = m.estado_cumplimiento
          inner join pais p on m.id_pais = p.id_pais
          where m.id_plan = ?
          order by m.nro_compromiso ";

          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $id_plan);
          
          $sql->execute();

          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

        }

        public function get_count_comixta_by_id_plan($id_plan){
 
          $conectar=parent::conexion();
         // parent::set_names();

          $sql="count(m.id_matriz) as id_tema 
          FROM cmx_tema ct 
          inner JOIN cmx_matriz m on ct.id_tema = m.id_tema 
          inner join cmx_estado est on est.id_estado_cumplimiento = m.estado_cumplimiento
          inner join pais p on m.id_pais = p.id_pais
          where m.id_plan = ?
          order by m.nro_compromiso ";

          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $id_plan);
          
          $sql->execute();

          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

        }



        public function get_matriz_por_id_pais_cu($id_pais,$id_usu){
 
          $conectar=parent::conexion();
         // parent::set_names();

          $sql="SELECT m.id_matriz, m.subgrupo, m.nro_compromiso, ct.tema as id_tema, m.id_entidad, p.pais as id_pais, m.compromiso, 
          m.entidad_responsable, m.entidad_responsable_2, m.contacto, m.fecha_cumplimiento, m.observaciones, 
          est.estado_cumplimiento,m.fecha_actualizacion, m.id_usuario 
          FROM cmx_tema ct 
          inner JOIN cmx_matriz m on ct.id_tema = m.id_tema 
          inner join cmx_estado est on est.id_estado_cumplimiento = m.estado_cumplimiento
          inner join pais p on m.id_pais = p.id_pais
          where m.id_pais = ? and m.id_usuario = ?
          order by m.nro_compromiso";

          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $id_pais);
          $sql->bindValue(2, $id_usu); 
          $sql->execute();

          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

        }

        public function get_comixta_by_id_pais($id_pais){

          $conectar= parent::conexion();


          $sql="select * from cmx_plan where id_pais=?";

           $sql=$conectar->prepare($sql);

           $sql->bindValue(1, $id_pais);
           $sql->execute();

           return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

     }

     public function get_comixta_by_id_pais_p($id_pais){

          $conectar= parent::conexion();

       

            $sql="select * from cmx_plan where id_pais=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_pais);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


    }

    public function get_titulo_por_id_plan($id_plan){
        
      $conectar=parent::conexion();
    // parent::set_names();

      $sql="SELECT pl.id_plan, pl.plan 
      FROM cmx_plan pl
      where pl.id_plan = ?
      LIMIT 1
      ";

      $sql=$conectar->prepare($sql);
      $sql->bindValue(1, $id_plan);
      
      $sql->execute();

      return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

    }

  }


   ?>