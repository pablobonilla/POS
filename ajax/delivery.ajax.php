<?php

require_once "../controladores/delivery.controlador.php";
require_once "../modelos/delivery.modelo.php";

class Ajaxdelivery{

	/*=============================================
	EDITAR delivery
	=============================================*/	

	public $iddelivery;

	public function ajaxEditardelivery(){

		$item = "id";
		$valor = $this->iddelivery;
				
		$respuesta = Controladordelivery::ctrMostrarDelivery($item, $valor);
		
		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR delivery
=============================================*/	

if(isset($_POST["idDelivery"])){

	$delivery = new Ajaxdelivery();
	$delivery -> iddelivery = $_POST["idDelivery"];
	$delivery -> ajaxEditardelivery();

}