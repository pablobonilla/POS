<?php

class ControladorDelivery{

	/*=============================================
	CREAR Delivery
	=============================================*/

	static public function ctrCrearDelivery(){
		
		
		if(isset($_POST["nuevoDelivery"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDelivery"]) &&
			   preg_match('/^[\-0-9]+$/', $_POST["nuevoDocumentoId"]) &&
			//    preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) 
			//    && 
			//    preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])
			   
			   ){

			   	$tabla = "delivery";

			   	$datos = array("nombre"=>$_POST["nuevoDelivery"],
					           "cedula"=>$_POST["nuevoDocumentoId"],
					           "email"=>$_POST["nuevoEmail"],
					           "telefono"=>$_POST["nuevoTelefono"],
							   "direccion"=>$_POST["nuevaDireccion"],
							   "estado_civil"=>$_POST["nuevoEstadoCivil"],
					           "fecha_nacimiento"=>$_POST["nuevaFechaNacimiento"]);

			   	$respuesta = ModeloDelivery::mdlIngresarDelivery($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Delivery ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "delivery";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Delivery no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "delivery";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR Delivery
	=============================================*/

	static public function ctrMostrarDelivery($item, $valor){

		$tabla = "delivery";

		$respuesta = ModeloDelivery::mdlMostrarDelivery($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR Delivery
	=============================================*/

	static public function ctrEditarDelivery(){

		if(isset($_POST["editarDelivery"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["editarDelivery"]) &&
			   preg_match('/^[\-0-9]+$/', $_POST["editarDocumentoId"]) &&
			//    preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) 
			//    && 
			//    preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])
			   
			   ){

			   	$tabla = "delivery";

			   	$datos = array("id"=>$_POST["idDelivery"],
			   				   "nombre"=>$_POST["editarDelivery"],
					           "cedula"=>$_POST["editarDocumentoId"],
					           "email"=>$_POST["editarEmail"],
							   "telefono"=>$_POST["editarTelefono"],
							   "estado_civil"=>$_POST["editarEstadoCivil"],
					           "direccion"=>$_POST["editarDireccion"],
					           "fecha_nacimiento"=>$_POST["editarFechaNacimiento"]);

			   	$respuesta = ModeloDelivery::mdlEditarDelivery($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Delivery ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "delivery";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Delivery no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "delivery";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR Delivery
	=============================================*/

	static public function ctrEliminarDelivery(){

		if(isset($_GET["idDelivery"])){

			$tabla ="delivery";
			$datos = $_GET["idDelivery"];

			$respuesta = ModeloDelivery::mdlEliminarDelivery($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Delivery ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "delivery";

								}
							})

				</script>';

			}		

		}

	}

}

