<?php

require_once "conexion.php";

class ModeloAnalisis{

	/*=============================================
	MOSTRAR ANIMALES
	=============================================*/

	static public function mdlMostrarAnimalesPesados($tabla){

        // $stmt = Conexion::conectar()->prepare("SELECT RFID, MIN(date) as primera_fecha, MAX(date) as ultima_fecha, (SELECT peso FROM animales a2 WHERE a2.rfid = a.rfid ORDER BY date ASC LIMIT 1) as primer_peso,
        // (SELECT peso FROM animales a2 WHERE a2.rfid = a.rfid ORDER BY date DESC LIMIT 1) as ultimo_peso  FROM animales a GROUP BY rfid HAVING COUNT(*) > 1 and empresa = 'Barlovento' and RFID not in (0,12345,1234,232323) order by date desc");
     
        $stmt = Conexion::conectar()->prepare("SELECT RFID, COUNT(*) AS cant_pesadas
        FROM animales where rfid not in (0,1234,12345,232323) AND empresa = 'Barlovento'
        GROUP BY RFID
        HAVING cant_pesadas > 1");

        $stmt -> execute();

        return $stmt -> fetchAll();

    }

    static public function mdlMostrarAnimales($tabla,$animales){

        // $stmt = Conexion::conectar()->prepare("SELECT RFID, MIN(date) as primera_fecha, MAX(date) as ultima_fecha, (SELECT peso FROM animales a2 WHERE a2.rfid = a.rfid ORDER BY date ASC LIMIT 1) as primer_peso,
        // (SELECT peso FROM animales a2 WHERE a2.rfid = a.rfid ORDER BY date DESC LIMIT 1) as ultimo_peso  FROM animales a GROUP BY rfid HAVING COUNT(*) > 1 and empresa = 'Barlovento' and RFID not in (0,12345,1234,232323) order by date desc");
     
        $stmt = Conexion::conectar()->prepare("SELECT idAnimal,RFID, date,mmGrasa,peso 
        FROM analisis where rfid in ($animales) ORDER BY date DESC");

        $stmt -> execute();

        return $stmt -> fetchAll();

    }

	static public function mdlCalcularADPV($rfid){
        
        $stmt = Conexion::conectar()->prepare("SELECT MIN(date) AS fecha_primer_pesaje, MAX(date) AS fecha_ultimo_pesaje
        FROM animales
        WHERE rfid = :rfid");

        $stmt -> bindParam(":rfid", $rfid, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();
        
    }

    static public function mdlObtenerPesos($rfid,$order){
        
        $stmt = Conexion::conectar()->prepare("SELECT peso
        FROM animales
        WHERE rfid = :rfid
        ORDER BY date $order
        LIMIT 1");

        $stmt -> bindParam(":rfid", $rfid, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();

    }
    


}