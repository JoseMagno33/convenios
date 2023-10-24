
<?php

   require_once("../config/conexion.php");


    if(isset($_SESSION["correo"])){



       /*Se llaman los modelos y se crean los objetos para llamar el numero de registros en el menu lateral izquierdo y en el home*/
      
      require_once("../modelos/Proveedores.php");
      require_once("../modelos/Compras.php");
      require_once("../modelos/Clientes.php");
      require_once("../modelos/Ventas.php");
      require_once("../modelos/matriz.php");

      
       $proveedor = new Proveedor();
       $compra = new Compras();
       $cliente = new Cliente();
       $venta = new Ventas();



        $datos=$compra->get_compras_anio_actual();

        $datos_venta=$venta->get_ventas_anio_actual();  


?>


<?php require_once("header.php");?>

     
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <img src="../public/images/bsconv.png" width="100%" height="100%"  />
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row panel_modulos">


          <?php  if($_SESSION["matrizpais"]==1 and $_SESSION["matriz"]==1)
            {

            echo '

                <div class="col-lg-3 col-xs-6">           
                <div class="small-box bg-red">
                  <div class="inner">
                    <a href="matriz.php">                  
                      <h4>&nbsp;</h4>
                      <h2>Convenios Bilaterales</h2>                  
                    </a>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users" aria-hidden="true""></i>
                  </div>              
                </div>
              </div>
            
            ';

            }
            else{
              if($_SESSION["matrizpais"]==1)
              echo '

              <div class="col-lg-3 col-xs-6">           
              <div class="small-box bg-red">
                <div class="inner">
                  <a href="matrizpais.php">                  
                    <h4>&nbsp;</h4>
                    <h2>Convenios Bilaterales</h2>                  
                  </a>
                </div>
                <div class="icon">
                  <i class="fa fa-users" aria-hidden="true""></i>
                </div>              
              </div>
            </div>
          
          ';


            }


         ?>

         
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">

                <a href="matrizmulti.php">
                  
                <h4>&nbsp;</h4>

                  <h2>Convenios Multilaterales</h2>
                </a>

              </div>
              <div class="icon">
                <i class="fa fa-users" aria-hidden="true""></i>
              </div>
              
            </div>
          </div>
          
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">

                <a href="matrizregional.php">
                  
                <h4>&nbsp;</h4>

                  <h2>Regionales</h2>
                </a>

              </div>
              <div class="icon">
                <i class="fa fa-users" aria-hidden="true""></i>
              </div>
              
            </div>
          </div>


    </div>



 <!--GRAFICA COMPRAS-->
    <div class="row">

          <div class="col-lg-6 col-xs-12 hidden">
        
         <div class="box">

               <div class="box-body">

               <h2 class="bg-primary text-white col-lg-12 text-center">RESUMEN DE COMPRAS DEL AÑO <?php echo date("Y");?></h2>

      
              <!--GRAFICA-->
             
              <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
            

                </div><!--fin box-body-->
          </div><!--fin box-->
      </div><!--col-sm-->


      <!--GRAFICA VENTAS-->
        <div class="col-lg-6 col-xs-12 hidden">
        
         <div class="box">

               <div class="box-body">

               <h2 class="bg-red text-white col-lg-12 text-center">RESUMEN DE VENTAS DEL AÑO <?php echo date("Y");?></h2>

      
              <!--GRAFICA-->
              <div id="container_ventas" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>



                </div><!--fin box-body-->
          </div><!--fin box-->
      </div><!--col-sm-->

    </div><!--fin row-->


        
           <!--FIN CONTENIDO-->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php require_once("footer.php");?>



  <script type="text/javascript">
   
   /*GRAFICA COMPRAS*/
     $(document).ready(function() {

      //Highcharts.chart('container', {

      var chart = new Highcharts.Chart({
      //$('#container').highcharts({
        
         chart: {
            
              renderTo: 'container', 
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },

              exporting: {
              url: 'http://export.highcharts.com/',
              enabled: false
        
                },

          title: {
              text: ''
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                showInLegend:true,
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',

                           fontSize: '20px'
                      }
                  }
              }
          },
           legend: {
              symbolWidth: 12,
              symbolHeight: 18,
              padding: 0,
              margin: 15,
              symbolPadding: 5,
              itemDistance: 40,
              itemStyle: { "fontSize": "17px", "fontWeight": "normal" }
          },

          series: [

                {
        name: 'Brands',
        colorByPoint: true,
        data: [

          <?php echo $datos_grafica= $compra->get_compras_anio_actual_grafica();?>

          ]

          }], 

          exporting: {
                enabled: false
             }

      });


});



   /*GRAFICA VENTAS*/
     $(document).ready(function() {

      //Highcharts.chart('container', {

      var chart = new Highcharts.Chart({
      //$('#container').highcharts({
        
         chart: {
            
              renderTo: 'container_ventas', 
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },

              exporting: {
              url: 'http://export.highcharts.com/',
              enabled: false
        
                },

          title: {
              text: ''
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                showInLegend:true,
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',

                           fontSize: '20px'
                      }
                  }
              }
          },
           legend: {
              symbolWidth: 12,
              symbolHeight: 18,
              padding: 0,
              margin: 15,
              symbolPadding: 5,
              itemDistance: 40,
              itemStyle: { "fontSize": "17px", "fontWeight": "normal" }
          },

          series: [

                {
        name: 'Brands',
        colorByPoint: true,
        data: [

        <?php echo $datos_grafica= $venta->get_ventas_anio_actual_grafica();?>
          ]

          }], 

          exporting: {
                enabled: false
             }

      });


});


  
</script>


<?php
     
     } else {

        header("Location:".Conectar::ruta()."index.php");
        exit();
     }
  ?>


