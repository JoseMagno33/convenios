<?php

   require_once("../config/conexion.php");
   require_once("../modelos/pais.php");
   require_once("../modelos/Usuarios.php");
   require_once("../modelos/matrizmulti.php");
   $pais = new Pais();
   $user = new Usuarios();
   
   $ent = new MatrizMulti();

   

    if(isset($_SESSION["id_usuario"])){
       
    $datos=$pais->get_pais();      
    $datosU=$user->get_usuarios();  
    $datosE=$ent->get_entidad_padre();  
    $datosM=$ent->get_entidades_m();  
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

             <h2>Listado de convenios multilaterales</h2>

            <div class="row">
            <div class="box col-md-2">
                          <div class="box-header with-border">
                                <div class="pull-left">
                                    <select name="lst_entidad" id="lst_entidad" class="form-control">
                                        <option value="0">SELECCIONE UNA ENTIDAD</option>
                                        <?php foreach($datosE as $a): ?>
                                          <option value="<?php echo $a["id_entidad"]; ?>">
                                            <?php echo $a["nombre_entidad"]; ?>
                                          </option>
                                          <?php endforeach; ?>
                                    </select>
                                   
                                    <button class="btn btn-primary" id="add_button" onclick="buscarcomponentes()" ><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>                     
                                    <button class="btn btn-primary " id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#matrizmultiModal"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Registro</button>
                                </div>
                        
                            </div>

                      </div>  
                      <div id="vista_b">
                            <div class="box col-md-12">
                                <div class="box-header with-border">
                                    <div class="pull-left">
                                        <div class="row">
                                            <div id="selectlistamulti">  
                                            </div>
                                            <button  class="btn btn-primary"  onclick="buscarsubcomponentes()"><i class="fa fa-search" aria-hidden="true"></i>Buscar</button> 
                                        </div>  
                                        
                                    </div>
                                   
                                </div>
                            </div>
                       </div>       
                      
              <div class="col-md-12">
                                  
                                                      

                    <!-- centro -->
                      
                    
                                  <div class="box">
                                                                      <div class="panel-body table-responsive">
                                                                            <table id="multi_data" class="table table-bordered table-striped">

                                                                              <thead>
                                                                                
                                                                                  <tr>
                                                                                  <th>Programa</th> 
                                                                                  <th>Descripción</th>
                                                                                  
                                                                                  <th>Archivo</th>   
                                                                                  <th>Fecha</th>                                                                                                                                                                 
                                                                                  <th width="10%">Acciones</th>
                                                                                  
                                                                                  </tr>
                                                                              </thead>

                                                                              <tbody>

                                                                              </tbody>

                                                                            </table>
                                                                      
                                                                      </div>
                                                      
                                  </div><!-- /.box -->



                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->






  <!--Fin-Contenido-->
    
   <!--FORMULARIO VENTANA MODAL-->
  
<div id="matrizmultiModal" class="modal fade">
  <div class="modal-dialog">
    <form class="form-horizontal" method="post" id="matriz_form">
      <div class="modal-content">
      
        <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Convenio</h4>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Entidad</label>

                  <div class="col-lg-9 col-lg-offset-1">                     
                      <select name="id_entidad"  id="id_entidad"  class="form-control" >
                                  <option value="">-- Selecciona Entidad--</option>
                                  <?php foreach($datosM as $a): ?>
                                      <option value="<?php echo $a["id_entidad"];?>">
                                              <?php echo $a["nombre_entidad"]; ?>
                                      </option>
                                  <?php endforeach; ?>
                      </select>  
                  </div>
                </div>
               
                <div class="form-group">
                  <label for="inputText3" class="col-lg-1 control-label">Descripcion</label>
                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" >
                  </div>
                </div>
                <div class="form-group">
                   <label for="inputText1" class="col-lg-1 control-label">Archivo</label>                  
                    <div class="col-lg-9 col-lg-offset-1">
                      <!--producto_pdf-->
                          <input type="file" id="nombre_archivo" name="nombre_archivo">                
                          <span id="producto_uploaded_image"></span>                        
                    </div>               
                </div> 
               <div class="form-group">
                  <label for="inputText3" class="col-lg-1 control-label">Fecha</label>
                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="fecha" name="fecha" placeholder="Fecha" >
                  </div>
               </div>

             
                 
          </div>
                 <!--modal-body-->

        <div class="modal-footer">
        <input type="hidden" name="id_multilateral" id="id_multilateral"/>
  
        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/> 

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

