<?php
require_once "../../controladores/veterinarios.controlador.php";
require_once " ../../../../modelos/veterinarios.modelo.php";
require_once "../../controladores/productores.controlador.php";
require_once " ../../../../modelos/productores.modelo.php";
require_once "../../controladores/aftosa.controlador.php";
require_once " ../../../../modelos/aftosa.modelo.php";
require_once "../../controladores/actas.controlador.php";
require_once " ../../../../modelos/actas.modelo.php";
require_once "../../controladores/animales.controlador.php";
require_once " ../../../../modelos/animales.modelo.php";

function formatearFecha($fecha){
    
    $fechaExplode = explode('-',$fecha);
    
    $fechaFormateada = $fechaExplode[2]."-".$fechaExplode[1]."-".$fechaExplode[0];
    
    return $fechaFormateada;
    
}

$informe = $_GET['informe'];

class informePDF{

    public $matricula;

    public function informe1(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Sistema integrado de Vacunacion Anti-Aftosa';

        $cabezera = 'Animales Totales Vacunados por Vacunador';

        include 'cabezera.php';

        $pdf->Ln(18);
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
                
                $total .= $totalVacunados;
                
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


if($informe == 'informe1'){

    $informeGeneral = new informePDF();
    $informeGeneral -> informe1();

}


?>