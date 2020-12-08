<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
    <i class="fa fa-motorcycle"></i>
      <strong>  Administrar Delivery </strong>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Delivery</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDelivery">
          
          Agregar Delivery

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Cédula</th>
           <th>Nombre</th>           
           <th>Teléfono</th>
           <th>Dirección</th>
           <th>Fecha Nacimiento</th> 
           <th>Estado Civil</th>
           <th>Ingreso al sistema</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $Delivery = ControladorDelivery::ctrMostrarDelivery($item, $valor);
        
          foreach ($Delivery as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["cedula"].'</td>
                    
                    <td>'.$value["nombre"].'</td>

                                        
                    <td>'.$value["telefono"].'</td>

                    <td>'.$value["direccion"].'</td>

                    <td>'.$value["fecha_nacimiento"].'</td>             

                    <td>'.$value["estado_civil"].'</td>

                    <td>'.$value["fecha"].'</td>

                    
                    <td>

                      <div class="btn-group">
                        
                        <button class="btn btn-warning btnEditarDelivery" data-toggle="modal" data-target="#modalEditarDelivery" idDelivery="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';


                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarDelivery" idDelivery="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                      }

                      echo '</div>  

                    </td>

                  </tr>';
          
            }

        ?>
   
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR Delivery
======================================-->

<div id="modalAgregarDelivery" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Delivery</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Nombre&nbsp;&nbsp;&nbsp;&nbsp;</span> 

                <input type="text" class="form-control input-lg" name="nuevoDelivery" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
                              
                <span class="input-group-addon"><i class="fa fa-key"></i>&nbsp;Cédula&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

                <input type="text"  class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar Cédula"  data-inputmask="'mask':'999-9999999-9'" data-mask >

              </div>

            </div>

            
            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
                              
                <span class="input-group-addon"><i class="fa fa-phone"></i>&nbsp;Teléfono&nbsp;&nbsp;&nbsp;&nbsp;</span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
              <span class="input-group-addon"><i class="fa fa-map-marker"></i>&nbsp;Dirección&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                
                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" >

              </div>

            </div>


            <!-- ENTRADA PARA EL ESTADO CIVIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                </i>Estado Civil&nbsp;&nbsp;&nbsp;</span> 

                <select class="form-control input-lg" name="nuevoEstadoCivil">
                  
                  <option value="">Selecionar Estado Civil</option>

                  <option value="Soltero">Soltero</option>

                  <option value="Casado">Casado</option>

                  <option value="Viudo">Viudo</option>

                  <option value="Divorciado">Divorciado</option>

                  <option value="Otro">Otro</option>


                </select>

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;Fecha Nac.</span>

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" id="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask >

                <span class="input-group-addon">
                &nbsp;Edad</span> 

                <input type="text" disabled class="form-control input-lg" name="ageA" id="ageA" value="">
                


              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Delivery</button>

        </div>

      </form>

      <?php

        $crearDelivery = new ControladorDelivery();
        $crearDelivery -> ctrCrearDelivery();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR Delivery
======================================-->

<div id="modalEditarDelivery" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Delivery</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i>&nbsp;Cédula&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 

                <input type="text" class="form-control input-lg" name="editarDocumentoId" id="editarDocumentoId" data-inputmask="'mask':'999-9999999-9'" data-mask >

               
              </div><!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Nombre&nbsp;&nbsp;&nbsp;&nbsp;</span> 

                <input type="text" class="form-control input-lg" name="editarDelivery" id="editarDelivery" required>
                <input type="hidden" id="idDelivery" name="idDelivery">
              </div>

            </div>

            </div>

            
            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i>&nbsp;Teléfono&nbsp;&nbsp;&nbsp;&nbsp;</span> 

                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i>&nbsp;Dirección&nbsp;&nbsp;&nbsp;&nbsp;</span> 

                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion">

              </div>

            </div>

            <!-- ENTRADA PARA EL ESTADO CIVIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                  <!-- <i class="fa fa-users"> -->

                </i>Estado Civil&nbsp;&nbsp;&nbsp;</span> 

                <select class="form-control input-lg" name="editarEstadoCivil">
                  
                    <option value="" id="editarEstadoCivil"></option>
                                    
                    <option value="Soltero">Soltero</option>

                    <option value="Casado">Casado</option>

                    <option value="Viudo">Viudo</option>

                    <option value="Divorciado">Divorciado</option>

                    <option value="Otro">Otro</option>


                </select>

              </div>

            </div>

            
             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group col-md-12">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;Fecha Nac.</span> 

                <input type="text" class="form-control input-lg" name="editarFechaNacimiento" id="editarFechaNacimiento"  data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>

                <span class="input-group-addon">
                &nbsp;Edad</span> 

                <input type="text" disabled class="form-control input-lg" name="age" id="age" value="">
                

              </div>

              <!-- <div class="input-group col-md-">
              
                

              </div> -->

              

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

      </form>

      <?php

        $editarDelivery = new ControladorDelivery();
        $editarDelivery -> ctrEditarDelivery();

      ?>

    

    </div>

  </div>

</div>

<?php

  $eliminarDelivery = new ControladorDelivery();
  $eliminarDelivery -> ctrEliminarDelivery();

?>


