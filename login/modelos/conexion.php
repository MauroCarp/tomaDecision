<?php

class Conexion{

	// static public function conectar(){

	// 	$link = new PDO("mysql:host=localhost;dbname=hoteleria",
	// 		            "root",
	// 		            "");

	// 	$link->exec("set names utf8");

	// 	return $link;

	// }

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=login",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}


}