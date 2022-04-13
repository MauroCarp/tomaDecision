<?php
require_once "../../controladores/carpetas.controlador.php";
require_once " ../../../../modelos/carpetas.modelo.php";

require_once "../../controladores/animales.controlador.php";
require_once " ../../../../modelos/animales.modelo.php";

function formatearFecha($fecha){
    
    $fechaExplode = explode('-',$fecha);
    
    $fechaFormateada = $fechaExplode[2]."-".$fechaExplode[1]."-".$fechaExplode[0];
    
    return $fechaFormateada;
    
}

$informe = (isset($_GET['informe'])) ?  $_GET['informe'] : false;

class informePDF{

    public $idCarpeta;
    
    public function informeCarpeta(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------
        $item = 'idCarpeta';
        
        $valor = $this->idCarpeta;
    
        $orden = 'fecha';

        $carpeta = ControladorCarpetas::ctrMostrarCarpetas($item,$valor,$orden,'ASC');

        
        if($carpeta[0]['activa']){
            
            $item = 'idCarpeta';
            
            $datos = 'desactivar';

            $desactivarCarpeta = ControladorCarpetas::ctrEditarCarpeta($item, $carpeta[0]['idCarpeta'],$datos);

            $priorizarCarpetas = ControladorCarpetas::ctrPriorizar($carpeta[0]['prioridad']);
            
        }

        $today = date('d/m/Y');

        $destino = $carpeta[0]['destino'];

        $descripcion = $carpeta[0]['descripcion'];

        $cabezera = "Informe de Carpeta";
        
        $perfil = "Perfil: $destino";

        $destino = "Destino: $descripcion";
        

        $fecha = "Fecha: $today";
        
        include 'cabezera.php';

        $pdf->SetFont('helvetica','B',12);
        
        $pdf->Cell(35,7,'Total Animales',0,0,'L',0);
        $pdf->Cell(40,7,utf8_decode('Clasificación'),0,0,'C',0);
        $pdf->Cell(25,7,'Peso Min.',0,0,'L',0);
        $pdf->Cell(20,7,'Peso Max.',0,1,'L',0);
        
        $pdf->SetFont('helvetica','',12);

        $cantidad = ($carpeta[0]['cantidad'] == 0) ? "Libre" : $carpeta[0]['cantidad'];

        $pdf->Cell(35,7,$cantidad,0,0,'C',0);

        $clasificacion = ($carpeta[0]['clasificacion'] != '') ? $carpeta[0]['clasificacion'] : $carpeta[0]['minGrasa']." mm / ".$carpeta[0]['maxGrasa']." mm"; 

        $pdf->Cell(40,7,$clasificacion,0,0,'C',0);

        $pesoMin = $carpeta[0]['pesoMin'];
        $pesoMax = $carpeta[0]['pesoMax'];

        if($carpeta[0]['pesoMax'] == 10000){
        
            $pesoMin = 'Libre';
            $pesoMax = 'Libre';

        } 

        $pdf->Cell(25,7,$pesoMin,0,0,'C',0);
        $pdf->Cell(20,7,$pesoMax,0,1,'C',0);

        $item = 'idCarpeta';

        $animales = ControladorAnimales::ctrMostrarAnimales($item, $valor);

        $pdf->Ln(5);


        $pdf->SetFillColor(220,220,220);

        $pdf->Cell(30,7,'RFID',1,0,'L',1);
        $pdf->Cell(30,7,'mm Grasa',1,0,'C',1);
        $pdf->Cell(25,7,'Peso',1,0,'C',1);
        $pdf->Cell(25,7,'Sexo',1,0,'C',1);
        $pdf->Cell(40,7,utf8_decode('Clasificación'),1,1,'C',1);
        
        $valido = true;
        $pesoTotal = 0;
        $totalAnimales = 0;
        $pesoMin = ($carpeta[0]['animales'] != 0) ? 9999 : 0;
        $pesoMax = 0;

        $pesos = array();
        
        foreach ($animales as $key => $animal) {

            $pesos[] = $animal['peso'];

            if($valido){
                $pdf->SetFillColor(250,250,250);
                $valido = false;
            }else{
                $pdf->SetFillColor(240,240,240);
                $valido = true;
            }

            if($animal['sexo'] == 'M')
                $sexo = 'Macho';
            else
                $sexo = 'Hembra';
            
            switch ($animal['clasificacion']) {
                case 'F':
                    $clasificacion = 'Flaca';
                    break;

                case 'B':
                    $clasificacion = 'Buena';
                    break;

                case 'B+':
                    $clasificacion = 'Buena +';
                    break;

                case 'MB':
                    $clasificacion = 'Muy Buena';
                    break;

                case 'AP':
                    $clasificacion = 'Apenas Gorda';
                    break;

                case 'G':
                    $clasificacion = 'Gorda';
                    break;
                
                default:
                    # code...
                    break;
            }
            
            $pdf->Cell(30,7,$animal['RFID'],0,0,'L',1);
            $pdf->Cell(30,7,$animal['mmGrasa']." mm",0,0,'C',1);
            $pdf->Cell(25,7,$animal['peso'],0,0,'C',1);
            $pdf->Cell(25,7,$sexo,0,0,'C',1);
            $pdf->Cell(40,7,$clasificacion,0,1,'C',1);

            $pesoTotal += $animal['peso'];
            $totalAnimales++;
            $pesoMin = ($animal['peso'] < $pesoMin) ? $animal['peso'] : $pesoMin;
            $pesoMax = ($animal['peso'] > $pesoMax) ? $animal['peso'] : $pesoMax;

        }

        $pdf->Ln(8);

        $pdf->SetFillColor(0,0,0);

        $pdf->Cell(150,0.01,'',0,1,'C',1);
        $pdf->Ln(3);

        $pdf->Cell(30,7,'Kg TOTAL',0,0,'C',0);
        $pdf->Cell(0.01,7,'',1,0,'C',0);
        $pdf->Cell(35,7,'Kg PROMEDIO',0,0,'C',0);
        $pdf->Cell(0.01,7,'',1,0,'C',0);
        $pdf->Cell(30,7,'Peso Min.',0,0,'C',0);
        $pdf->Cell(0.01,7,'',1,0,'C',0);
        $pdf->Cell(30,7,'Peso Max.',0,0,'C',0);
        $pdf->Cell(0.01,7,'',1,0,'C',0);
        $pdf->Cell(30,7,'Desv. Est.',0,1,'C',0);
        
        $pesoPromedio = $pesoTotal / $totalAnimales;


        $pdf->Cell(30,7,$pesoTotal." Kg",0,0,'C',0);
        $pdf->Cell(0.01,7,'',1,0,'C',0);
        $pdf->Cell(35,7,number_format($pesoPromedio,0)." Kg",0,0,'C',0);
        $pdf->Cell(0.01,7,'',1,0,'C',0);
        $pdf->Cell(30,7,$pesoMin." Kg",0,0,'C',0);
        $pdf->Cell(0.01,7,'',1,0,'C',0);
        $pdf->Cell(30,7,$pesoMax." Kg",0,0,'C',0);
        $pdf->Cell(0.01,7,'',1,0,'C',0);

        $distanciasCuadrada = array();

        foreach ($pesos as $key => $value) {

            $distancia = $pesoPromedio - $value;

            $distanciasCuadrada[] = pow(abs($distancia),2);

        }

        $sumaDistanciasCuadradas = array_sum($distanciasCuadrada);

        $desvioEstandar  = $sumaDistanciasCuadradas / $totalAnimales;


        $pdf->Cell(30,7,number_format(sqrt($desvioEstandar),2),0,1,'C',0);

        $pdf->Ln(5);
        $pdf->SetFont('Times','B',14);
    
        $pdf->Output();
        

    }

}


if($informe){

    $informeCarpeta = new informePDF();
    $informeCarpeta -> idCarpeta = $_GET['idCarpeta'];
    $informeCarpeta -> informeCarpeta();

}



?>