<?php
   //llamamos al archivo excel 
   require_once("../excel/Classes/PHPExcel.php");

   //lamamos a los demás recursos
   require_once("../config/conexion.php");
   require_once("../modelos/pais.php");
   require_once("../modelos/Usuarios.php");
   require_once("../modelos/tema.php");
   require_once("../modelos/plan.php");
   require_once("../modelos/gestion.php");
   
   $pais = new Pais();
   $user = new Usuarios();
   $tem = new Tema();
   $gestion = new Gestion();  
   $plan = new Plan();  

    if(isset($_SESSION["id_usuario"])){
       
    $datos=$pais->get_pais();      
    $datosU=$user->get_usuarios();  
    $datosT=$tem->get_tema();  
    $datosP=$plan->get_plan();
    $datosg=$gestion->get_gestion();      
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

            <h2>Listado de Matrices</h2>

            <div class="row">
              
              <div class="col-md-12">
                      <div class="box col-md-2">
                          <div class="box-header with-border">
                                <div class="pull-left">
                                    <select name="lst_pais" id="lst_pais" class="form-control">
                                        <option value="0">SELECCIONE UN PAIS</option>
                                        <?php foreach($datos as $a): ?>
                                          <option value="<?php echo $a["id_pais"]; ?>">
                                            <?php echo $a["pais"]; ?>
                                          </option>
                                          <?php endforeach; ?>
                                    </select>
                                    
                                    <select name="id_usu" id="id_usu" class="form-control">
                                        <option value="0">SELECCIONE UN USUARIO</option>
                                        <?php foreach($datosU as $a): ?>
                                          <option value="<?php echo $a["id_usuario"]; ?>">
                                            <?php echo $a["usuario"]; ?>
                                          </option>
                                          <?php endforeach; ?>
                                    </select>
                                  
              
                                    <button class="btn btn-primary" id="add_button" onclick="listar_matriz_por_pais2()" ><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>                     
                                    <button class="btn btn-primary " id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#matrizModal"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Registro</button>
                                </div>
                        
                            </div>

                      </div>                  
                    <div id="vista_b">
                            <div class="box col-md-12">
                                <div class="box-header with-border">
                                    <div class="pull-left">
                                        <div class="row">
                                            <div id="selectlistacom">  
                                            </div>
                                            <div id="row" >
                                                <button  class="btn btn-primary"  onclick="listar_matriz_tabla()"><i class="fa fa-search" aria-hidden="true"></i>Buscar Matriz</button> 
                                            </div>
  
                                        </div>  
                                        <div class="row">     
                                          <select class="form-control" id="tipov" name="tipov">
                                              <option value="">SELECCIONE UN TIPO DE DOCUMENTO</option>
                                              <option value="convenio" >Convenio</option>
                                              <option value="acuerdo">Acuerdo</option>
                                              <option value="memorandum">Memorandum</option>
                                              <option value="acta">Acta</option>
                                              <option value="otro">Otro</option>                                                    
                                          </select>
                                          
                                          <button  class="btn btn-primary"  onclick="listar_archivos()"><i class="fa fa-search" aria-hidden="true"></i>Buscar Documento</button> 
                                   
                                        <div>
                                    </div>
                                   
                                </div>
                            </div>
                    </div>              

                    <!-- /.box-header -->
                   

                    <div id="vista_a">
                            <div class="panel-body table-responsive" >
                                <!--//tabla archivos-->
                                      <table id="archivo_data" class="table table-bordered table-striped">

                                              <thead>
                                                
                                                  <tr>                                                                                                  
                                                  <th>Descripcion</th>
                                                  <th>Tipo de documento</th>
                                                  <th>Archivo</th>                                                  
                                                  
                                                  </tr>
                                              </thead>

                                        <tbody>

                                        </tbody>


                                        </table>        
                                  <!-- fin tabla -->

                            </div>
                      </div>                                  

                    <!-- centro -->
                    <div id="resultadoajax" style="word-wrap: break-word;">

                    </div>

                    <div id="tablamatriz" style="word-wrap: break-word;">

                    </div> 
                    
                    <div id="vista_c">
                          
                    </div>  
                    
                      
                     
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  <!--FORMULARIO VENTANA MODAL-->
<div id="matrizModal" class="modal fade">
  <div class="modal-dialog">
    <form class="form-horizontal" method="post" id="matriz_form">
      <div class="modal-content">
      
        <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Matriz</h4>
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
                  <label for="inputText4" class="col-lg-1 control-label">Tema</label>

                  <div class="col-lg-9 col-lg-offset-1">                     
                      <select name="id_tema"  id="id_tema"  class="form-control" >
                                  <option value="">-- Selecciona tema --</option>
                                  <?php foreach($datosT as $a): ?>
                                      <option value="<?php echo $a["id_tema"];?>">
                                              <?php echo $a["tema"]; ?>
                                      </option>
                                  <?php endforeach; ?>
                      </select>  
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-lg-1 control-label">Subgrupo</label>
                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="subgrupo" name="subgrupo" placeholder="Subgrupo" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-lg-1 control-label">Nro</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="nro_compromiso" name="nro_compromiso" placeholder="nro compromiso" >
                  </div>
                </div>
               <div class="form-group">
                  <label for="inputText3" class="col-lg-1 control-label">Compromiso</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <textarea rows="2" class="form-control" id="compromiso" name="compromiso" placeholder="Compromiso" >
                    </textarea>
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputText1" class="col-lg-1 control-label">Entidad Responsable Bolivia</label>

                  <div class="col-lg-9 col-lg-offset-1">
                  <textarea type="text" class="form-control" id="entidad_responsable" name="entidad_responsable" placeholder="Entidad Responsable">
                  </textarea>
                </div>
              </div>

              <div class="form-group">
                  <label for="inputText1" class="col-lg-1 control-label"><div id="ent_r2"></div></label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <textarea type="text" class="form-control" id="entidad_responsable_2" name="entidad_responsable_2" placeholder="Entidad Responsable">
                    </textarea>                
                  </div>
              </div>

                <div class="form-group">
                  <label for="inputText1" class="col-lg-1 control-label">Contacto</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <textarea type="text" class="form-control" id="contacto" name="contacto" placeholder="Contacto" >
                    </textarea>                
                  </div>
              </div>

               <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Fecha Cumplimiento</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <input type="text" class="form-control" id="fecha_cumplimiento" name="fecha_cumplimiento" placeholder="Fecha Cumplimiento" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Acciones realizadas</label>

                  <div class="col-lg-9 col-lg-offset-1">
                    <textarea type="text" class="form-control" id="observaciones" name="observaciones" placeholder="observaciones" required="required">
                    </textarea>                
                  </div>
                </div>

               <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Estado Cumplimiento</label>

                  <div class="col-lg-9 col-lg-offset-1">

                      <select class="form-control" id="estado_cumplimiento" name="estado_cumplimiento" required>
                          <option value="">-- Selecciona estado --</option>
                          <option value="1" selected>Cumplido</option>
                          <option value="2">No Cumplido</option>
                          <option value="3">En proceso</option>                      
                      </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputText4" class="col-lg-1 control-label">Usuario</label>
                  <div class="col-lg-9 col-lg-offset-1">
                        <select name="id_usuario" id="id_usuario" class="form-control">
                                <option value="0" disabled>SELECCIONE UN USUARIO PARA ASIGNAR</option>
                                <?php foreach($datosU as $a): ?>
                                  <option value="<?php echo $a["id_usuario"]; ?>">
                                    <?php echo $a["usuario"]; ?>
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


<!--ABRIMOS OTRO MODAL-->

<div id="archivoModal" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">
      
          <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Archivos</h4>

          </div>
              <div class="modal-body">
               
                      <div id="vista_a">
                            <div class="panel-body table-responsive" >
                                <!--//tabla archivos-->
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
                                  <!-- fin tabla -->

                            </div>
                      </div>  
         
                       
              </div>
                 <!--modal-body-->

        <div class="modal-footer">          
          <!-- <input type="hidden" name="cedula_cliente" id="cedula_cliente"/>-->

          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
        </div>
     </div>
   
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

<script type="text/javascript" src="js/matriz.js"></script>



<?php
   
  } else {

        header("Location:".Conectar::ruta()."index.php");

  }

  

?>



