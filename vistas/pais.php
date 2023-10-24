<?php

   require_once("../config/conexion.php");

    if(isset($_SESSION["id_usuario"])){
       
       
?>



<?php
 
  require_once("header.php");

?>


  <?php if($_SESSION["usuarios"]==1)
     {

     ?>


  <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
             
             <div id="resultados_ajax"></div>

             <h2>Lista de Paises</h2>

            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">
                            <button class="btn btn-primary btn-lg" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#paisModal"><i class="fa fa-plus" aria-hidden="true"></i>Adicionar Pais</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive">
                          
                          <table id="pais_data" class="table table-bordered table-striped">

                            <thead>
                              
                                <tr>
                                
                                <th>Pais</th>
                                <th>Abreviación</th>
                                
                                
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
  
<div id="paisModal" class="modal fade">
  <div class="modal-dialog">
    <form class="form-horizontal" method="post" id="pais_form">
      <div class="modal-content">
      
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Matriz</h4>
        </div>
        <div class="modal-body">

               <div class="form-group">
                  <label for="inputText3" class="col-lg-1 control-label">Pais</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="pais" name="pais" placeholder="Pais" >
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputText1" class="col-lg-1 control-label">Abreviación</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="abrev" name="abrev" placeholder="Abreviación">
                  </div>
              </div>
      
          </div>
                 <!--modal-body-->

          <div class="modal-footer">
          <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
          <input type="hidden" name="id_pais" id="id_pais"/>
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

<script type="text/javascript" src="js/pais.js"></script>



<?php
   
  } else {

        header("Location:".Conectar::ruta()."index.php");

  }

  

?>

