<?php

require_once "../controladores/mesas.controlador.php";
require_once "../modelos/mesa.modelo.php";


class AjaxMesas{

	/*=============================================
	EDITAR MESA
	=============================================*/	

	public $idMesa;

	public function ajaxEditarMesa(){

		$item = "id";
		$valor = $this->idMesa;

		$respuesta = ControladorMesas::ctrMostrarMesas($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR MESA
=============================================*/	

if(isset($_POST["id"])){

	$mesa = new AjaxMesas();
	$mesa -> idMesa = $_POST["id"];
	$mesa -> ajaxEditarMesa();
}

