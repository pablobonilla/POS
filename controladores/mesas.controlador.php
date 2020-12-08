<?php

class ControladorMesas{

	/*=============================================
	CREAR MESAS
	=============================================*/

	static public function ctrCrearMesa(){
		
		
		if(isset($_POST["nuevaMesa"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMesa"])){

				$tabla = "mesas";

				$datos = array("nombre"=>$_POST["nuevaMesa"],
				"ubicacion"=>$_POST["nuevaUbicacion"]);


				$respuesta = ModeloMesas::mdlIngresarMesa($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Mesa ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "mesas";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La Mesaa no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "mesas";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR MESAS
	=============================================*/

	static public function ctrMostrarMesas($item, $valor){

		$tabla = "mesas";

		$respuesta = ModeloMesas::mdlMostrarMesas($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR MESA
	=============================================*/

	static public function ctrEditarMesa(){

		if(isset($_POST["editarMesa"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMesa"])){

				$tabla = "mesas";

				$datos = array("nombre"=>$_POST["editarMesa"],
							   "ubicacion"=>$_POST["editarUbicacion"],
							   "id"=>$_POST["idMesa"]);
				

				$respuesta = ModeloMesas::mdlEditarMesa($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Mesa ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "mesas";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La Mesa no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "mesas";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarMesa(){

		if(isset($_GET["idMesa"])){

			$tabla ="mesas";
			$datos = $_GET["idMesa"];

			$respuesta = ModeloMesas::mdlBorrarMesa($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La Mesa sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "mesas";

									}
								})

					</script>';
			}
		}
		
	}
}
