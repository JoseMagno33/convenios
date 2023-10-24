<?php

   require_once("../config/conexion.php");
   require_once("../modelos/archivo.php");
   require_once("../modelos/Usuarios.php");
   require_once("../modelos/pais.php");
   require_once("../modelos/tema.php");
  
   $pais = new Pais();
   $user = new Usuarios();
   $tem = new Tema();


   if(isset($_SESSION["id_usuario"])){
       
    $datos=$pais->get_pais();      
    $datosU=$user->get_usuarios();  
    $datosT=$tem->get_tema();  
       
      
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

             <h2>Lista de convenios adjuntos por pais</h2>

            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">
                            <button class="btn btn-primary btn-lg" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#archivoModal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Adicionar Archivo</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive">
                          
                          <table id="archivo_data" class="table table-bordered table-striped">

                            <thead>
                              
                                <tr>
                               
                                <th>Pais</th>
                                <th>Descripcion</th>
                                <th>Tipo</th>
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
  
<div id="archivoModal" class="modal fade">
  <div class="modal-dialog">
    <form class="form-horizontal" method="post" id="archivo_form">
      <div class="modal-content">
      
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Archivo</h4>
        </div>
        <div class="modal-body">

                <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Pais</label>

                  <div class="col-lg-9 col-lg-offset-1">                     
                        <select name="id_pais"  id="id_pais"  class="form-control" >
                                  <option value="">-- Selecciona Pais--</option>
                                  <?php foreach($datos as $a): ?>
                                      <option value="<?php echo $a["id_pais"];?>">
                                              <?php echo $a["pais"]; ?>
                                      </option>
                                  <?php endforeach; ?>
                      </select>  
                  </div>
                </div>

              <div class="form-group">
                  <label for="inputText1" class="col-lg-1 control-label">Descripción</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion">
                  </div>
              </div>
              <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Tipo de documento</label>

                  <div class="col-lg-9 col-lg-offset-1">

                      <select class="form-control" id="tipov" name="tipov" required>
                          <option value="">-- Selecciona tipo de archivo --</option>
                          <option value="convenio" >Convenio</option>
                          <option value="acuerdo">Acuerdo</option>
                          <option value="memorandum">Memorandum</option>
                          <option value="acta">Acta</option>
                          <option value="otro">Otro</option>
                                              
                      </select>
                  </div>    
                </div>
                <div class="form-group">

                        <div class="col-lg-9 col-lg-offset-1">

                          <!--producto_pdf-->

                              <input type="file" id="nombre_archivo" name="nombre_archivo">
                              
                              <span id="producto_uploaded_image"></span>

                        </div>

                </div>
      
          </div>
                 <!--modal-body-->

          <div class="modal-footer">
          <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
          <input type="hidden" name="id_archivo" id="id_archivo"/>

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

<script type="text/javascript" src="js/archivo.js"></script>



<?php
   
  } else {

        header("Location:".Conectar::ruta()."index.php");

  }

  

?>


