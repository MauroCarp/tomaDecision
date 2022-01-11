<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=sanidadanimal",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}

	static public function conectar2(){

		$link = new PDO("mysql:host=localhost;dbname=fissa",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}

}