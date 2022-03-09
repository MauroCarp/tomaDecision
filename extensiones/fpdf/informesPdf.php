<?php
require_once "../../controladores/carpetas.controlador.php";
require_once " ../../../../modelos/carpetas.modelo.php";

require_once "../../controladores/perfiles.controlador.php";
require_once " ../../../../modelos/perfiles.modelo.php";

function formatearFecha($fecha){
    
    $fechaExplode = explode('-',$fecha);
    
    $fechaFormateada = $fechaExplode[2]."-".$fechaExplode[1]."-".$fechaExplode[0];
    
    return $fechaFormateada;
    
}

$informe = (isset($_GET['informe'])) ?  $_GET['informe'] : false;

class informePDF{

    public $matricula;
    
    public $mail;

    public function informe1(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Animales Totales Vacunados por Vacunador';

        $cabezera = "Sistema integrado de Vacunacion Anti-Aftosa \n Animales Totales Vacunados por Vacunador";

        include 'cabezera.php';

        $pdf->Ln(5);
        $pdf->SetFont('Times','B',14);
        $pdf->SetX(40);
        $pdf->Cell(190,10,'(Incluyendo establecimientos de distintos Distritos)',0,1,'L',0);
        $pdf->SetX(40);
        $pdf->Cell(65,8,'VACUNADOR',1,0,'C',0);
        $pdf->Cell(45,8,'TOTAL',1,1,'C',0);
        $pdf->SetFont('Times','',12);
        
        $total = 0;

        $veterinarios = ControladorVeterinarios::ctrMostrarVeterinarios(null,null);

        foreach ($veterinarios as $key => $value) {
         
            $item = 'matricula';

            $totalVacunados = ControladorActas::ctrContarActas($item,$value['matricula']);

            $pdf->SetX(40);
            
            $pdf->Cell(85,8,utf8_decode($value['nombre']),0,0,'L',0);

            if ($totalVacunados[0] != null) {
            
                $pdf->Cell(45,8,number_format($totalVacunados[0],0,'','.'),0,1,'L',0);
                
                $total += $totalVacunados[0];
                
            }else{
                
                $pdf->Cell(45,8,number_format(0,0,'','.'),0,1,'L',0);

            }
        

        }
    
        $pdf->SetX(40);
        $pdf->SetFont('times','B',11);
        $pdf->Cell(85,8,'Total',0,0,'L',0);
        $pdf->Cell(45,8,number_format($total,0,'','.'),0,1,'L',0);
    
        $pdf->Output();
        

    }

}


if($informe){

    $informeGeneral = new informePDF();
    $informeGeneral -> $informe();

}



?>