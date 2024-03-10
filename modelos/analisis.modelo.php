<?php

require_once "conexion.php";

class ModeloAnalisis{

	/*=============================================
	MOSTRAR ANIMALES
	=============================================*/

	static public function mdlMostrarAnimales($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT *
        FROM animales
        WHERE RFID NOT IN (
            SELECT RFID
            FROM animales
            GROUP BY RFID
            HAVING COUNT(*) = 1
        ) and empresa = 'Barlovento' and RFID not in (0,12345,1234) order by RFID desc");

  

        $stmt -> execute();

        return $stmt -> fetchAll();

    }


}