<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=pablobonilla_pos",
			            "pablobonilla_pos",
			            "Magico1166");
			//$link = new PDO("mysql:host=localhost;dbname=pos",
			  //          "root",
			      //      "");            

		$link->exec("set names utf8");

		return $link;

	}

}