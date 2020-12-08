<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      <i class="fa fa-bar-chart" aria-hidden="true"></i>
      <strong> Reportes de Ventas </strong>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Reportes de ventas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="input-group">

          <button type="button" class="btn btn-default" id="daterange-btn2">

            <span>
              <i class="fa fa-calendar"></i>

              <?php

              if (isset($_GET["fechaInicial"])) {

                echo $_GET["fechaInicial"] . " - " . $_GET["fechaFinal"];
              } else {

                echo 'Rango de fecha';
              }

              ?>
            </span>

            <i class="fa fa-caret-down"></i>

          </button>

        </div>

        <div class="box-tools pull-right" >

          <?php

          if (isset($_GET["fechaInicial"])) {

            echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial=' . $_GET["fechaInicial"] . '&fechaFinal=' . $_GET["fechaFinal"] . '">';
          } else {

            echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';
          }

          ?>

          <button class="btn btn-success" style="margin-top:5px; margin-right:450px">
          <i class="fa fa-file-excel-o"></i>
          Descargar reporte en Excel</button>

          </a>

        </div>

        <!--  -->

        <div class="box-tools pull-right">



          <?php

          if (isset($_GET["fechaInicial"])) {
            
            $fechaIni = $_GET["fechaInicial"];
            $fechaFin = $_GET["fechaFinal"];


          }
          else {



            $fechaFin = date("Y-m-d");
            $d=strtotime("-1 Months");
            $fechaIni = date("Y-m-d",$d);
          }
              
            //ar_dump($fechaIni);

            // $d = date();
    
            // $dia = $d.getDate();
            // $mes = $d.getMonth()+1;
            // $año = $d.getFullYear();

            // if($mes < 10){

            //   $fechaIni = $año+"-0"+$mes+"-"+$dia;
            //   $fechaFin = $año+"-0"+$mes+"-"+$dia;

            // }else if($dia < 10){

            //   $fechaIni = $año+"-"+$mes+"-0"+$dia;
            //   $fechaFin = $año+"-"+$mes+"-0"+$dia;

            // }else if($mes < 10 && $dia < 10){

            //   $fechaIni = $año+"-0"+$mes+"-0"+$dia;
            //   $fechaFin = $año+"-0"+$mes+"-0"+$dia;

            // }else{

            //   $fechaIni = $año+"-"+$mes+"-"+$dia;
            //     $fechaFin = $año+"-"+$mes+"-"+$dia;

            // }

         // }



          
            /*

            echo '<a href="vistas/modulos/descargar-reporte.php?pdf=pdf&fechaInicial=' . $_GET["fechaInicial"] . '&fechaFinal=' . $_GET["fechaFinal"] . '">';
          } */
          
          

          /*else {

            echo '<a href="vistas/modulos/descargar-reporte.php?pdf=pdf">';
          }*/

          /**  para enviar la fecha reportes.js **/
          ?>

          <script type="text/javascript">


          var fechaIni = '<?=$fechaIni?>';
          var fechaFin = '<?=$fechaFin?>';

          
          </script>

          <button class="btn btn-danger" id="verPDF" style="margin-top:5px">
          <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
           Descargar PDF
          </button>

          </a>

        </div>
        <!--  -->


      </div>




      <div class="box-body">

        <div class="row">

          <div class="col-xs-12">

            <?php

            include "reportes/grafico-ventas.php";

            ?>

          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/productos-mas-vendidos.php";

            ?>

          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/vendedores.php";

            ?>

          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/compradores.php";

            ?>

          </div>

        </div>

      </div>

    </div>

  </section>

</div>