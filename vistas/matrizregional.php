<?php

   require_once("../config/conexion.php");
   require_once("../modelos/pais.php");
   require_once("../modelos/Usuarios.php");
   require_once("../modelos/entidad.php");
   $pais = new Pais();
   $user = new Usuarios();
   
   $ent = new Entidad();
   

    if(isset($_SESSION["id_usuario"])){
       
    $datos=$pais->get_pais();      
    $datosU=$user->get_usuarios();  
    $datosE=$ent->get_entidad();  
?>



<?php
 
  require_once("header.php");

?>


  <?php if($_SESSION["matriz"]==1)
     {

     ?>


  <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
             
             <div id="resultados_ajax"></div>

             <h2>Convenios Regionales</h2>
             
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                    <div class="pull-left">
                            <select name="lst_pais" id="lst_pais" class="form-control">
                                <option value="0" disabled>SELECCIONE UNA ENTIDAD</option>
                                  <option value="1">
                                      CERIAN
                                  </option>
                                 
                            </select>
                            
                            <button class="btn btn-primary" id="add_button" onclick="listar_regional()" ><i class="fa fa-search" aria-hidden="true"></i> Encontrar Datos</button></h1>                        
                            <button class="btn btn-primary " id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#regionalModal"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Registro</button>

                    </div>

                    <div class="box-tools pull-right">
                         
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive">
                          <table id="regional_data" class="table table-bordered table-striped">

                            <thead>
                              
                                <tr>                                
                                <th>Descripción</th>
                                <th>Fecha</th> 
                                <th>Archivo</th>
                                <th width="10%">Editar</th>
                                <th width="10%">Eliminar</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>

                          </table>
                     
                    </div>
                  
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
    
   <!--FORMULARIO VENTANA MODAL-->
  
<div id="regionalModal" class="modal fade">
  <div class="modal-dialog">
    <form class="form-horizontal" method="post" id="matriz_form">
      <div class="modal-content">
      
        <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Convenio</h4>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Pais</label>

                  <div class="col-lg-9 col-lg-offset-1">                     
                      <select name="id_pais"  id="id_pais"  class="form-control" >
                                  <option value="">-- Selecciona Paises--</option>
                                  <?php foreach($datos as $a): ?>
                                      <option value="<?php echo $a["id_pais"];?>">
                                              <?php echo $a["pais"]; ?>
                                      </option>
                                  <?php endforeach; ?>
                      </select>  
                  </div>
                </div>
                

          </div>
                 <!--modal-body-->

        <div class="modal-footer">
        <input type="hidden" name="id_matriz" id="id_matriz"/>
          <!-- <input type="hidden" name="cedula_cliente" id="cedula_cliente"/>-->
          

          <button type="submit" name="action" id="#" class="btn btn-success pull-left" value="Add"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar </button>

          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
        </div>
      </div>
    </form>
  </div>
</div>
 <!--FIN FORMULARIO VENTANA MODAL-->


  
  <?php  } else {

       require("noacceso.php");
  }
   
  ?><!--CIERRE DE SESSION DE PERMISO -->

<?php

  require_once("footer.php");
?>

<script type="text/javascript" src="js/matrizmulti.js"></script>



<?php
   
  } else {

        header("Location:".Conectar::ruta()."index.php");

  }

  

?>

