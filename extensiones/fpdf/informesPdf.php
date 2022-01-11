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

    public function informe2(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Total Bovinos Vacunados por localidad y total departamental';

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Total Bovinos Vacunados por localidad y total departamental";

        include 'cabezera.php';

        $pdf->Ln(10);
        $pdf->SetFont('Times','B',12);
        $pdf->SetX(10);
        $pdf->Cell(50,7,'IRIONDO',0,0,'L',0);
        $pdf->Cell(60,7,'DISTRITO',0,0,'L',0);
        $pdf->Cell(40,7,'TOTAL animales',0,0,'L',0);
        $pdf->Cell(50,7,'Cant. Establ.',0,1,'L',0);
        $pdf->Cell(185,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',10);
        $pdf->SetFillColor(0,0,0);
    
        $distinct = 'distrito';

        $distritos = ControladorProductores::ctrMostrarProductoresDistinct(null,null,$distinct);

        $renspasPorDistrito = array();

        $totalEstablecimientosGral = 0;

        $totalVacunadoGral = 0;

        $totalParcialGral = 0;

        $totales = array('establecimientos'=>0,'vacunados'=>0,'parcial'=>0,'animales'=>0);

        foreach ($distritos as $key => $value) {
            
            if($value[0] != null){      

                $item = 'distrito';
                
                $tabla = 'productores';
                
                $orden = 'propietario';
                
                $renspaDistrito = ControladorAftosa::ctrMostrarDatos($tabla,$item,$value[0],$orden);

                $totalAnimales = 0;

                $totalVacunados = 0;
                
                $totalParcial = 0;

                $totalEstablecimientos = sizeof($renspaDistrito);

                $totales['establecimientos'] += $totalEstablecimientos;

                $item = 'renspa';

                $item2 = 'campania';

                $valor2 = $_COOKIE['campania'];
                
                for ($i=0; $i < $totalEstablecimientos ; $i++) { 

                    $animales = ControladorAnimales::ctrMostrarAnimales($item,$renspaDistrito[$i]['renspa'],$item2,$valor2);
                    
                    $parcial =  ($animales['vaquillonas']  + $animales['toritos'] + $animales['terneros'] + $animales['terneras'] + $animales['novillos'] + $animales['novillitos']);

                    $totalParcial += $parcial;

                    $totales['parcial'] += $parcial;

                    $totalAnimales += ($animales['vacas'] + $animales['toros'] + $parcial);
                    
                    $totales['animales'] += ($animales['vacas'] + $animales['toros'] + $parcial);

                    $vacunados = ControladorActas::ctrMostrarActa($item,$renspaDistrito[$i]['renspa']);

                    $vacunados = ($vacunados) ? $vacunados['cantidadPar'] : 0;

                    $totalVacunados += $vacunados;

                    $totales['vacunados'] += $vacunados;

                }

                $nombreDistrito = ControladorProductores::ctrMostrarLocation('departamento',8,'localidad',$value[0]);

                $pdf->Cell(50,7,'',0,0,'L',0);
                $pdf->Cell(40,7,utf8_decode($nombreDistrito[0]['nombre']),0,0,'L',0);
                $pdf->Cell(30,7,'Total Vacunado',0,0,'L',0);
                $pdf->Cell(40,7,$totalVacunados,0,0,'L',0);
                $pdf->Cell(50,7,$totalEstablecimientos,0,1,'L',0);
                $pdf->Cell(90,7,'',0,0,'L',0);
                $pdf->Cell(30,7,'Total Animales',0,0,'L',0);
                $pdf->Cell(40,7,$totalAnimales,0,1,'L',0);
                $pdf->Cell(90,7,'',0,0,'L',0);
                $pdf->SetFont('Times','b',10);
                $pdf->Cell(30,7,'Parcial:',0,0,'L',0);
                $pdf->SetFont('Times','',10);
                $pdf->Cell(40,7,$totalParcial,0,1,'L',0);
                $pdf->SetX(60);
                $pdf->Cell(120,.1,'',0,1,'L',1);

            }

        }
    
        
        $pdf->SetTextColor(0,4,162);
        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(40,7,'Promedio de Animales:',0,0,'L',0);
        
        $promedio = number_format(($totales['vacunados'] / $totales['establecimientos']),2,',','.');
        
        $pdf->Cell(45,7,$promedio,0,0,'L',0);
        $pdf->Cell(35,7,'Total Vacunado:',0,0,'L',0);
        $pdf->Cell(40,7,$totales['vacunados'],0,0,'L',0);
        $pdf->Cell(40,7,$totales['establecimientos'],0,1,'L',0);
        $pdf->Cell(90,7,'',0,0,'L',0);
        $pdf->SetFont('helvetica','b',10);
        $pdf->Cell(30,7,'Total Animales:',0,0,'L',0);
        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(40,7,$totales['animales'],0,1,'L',0);
        $pdf->SetFont('helvetica','b',10);
        $pdf->Cell(90,7,'',0,0,'L',0);
        $pdf->Cell(30,7,'Parcial:',0,0,'L',0);
        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(40,7,$totales['parcial'],0,1,'L',0);
    
        $pdf->Output();
        
    }

    public function informe3(){
        
        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Detalle de Animales Vacunados por Vacunador con Bufalos/as';

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Detalle de Animales Vacunados por Vacunador con Bufalos/as";

        include 'cabezeraLand.php';

        $matricula = $this->matricula;

        $item = 'matricula';

        $veterinario = ControladorVeterinarios::ctrMostrarVeterinarios($item, $matricula);

        $nombreVeterinario = $veterinario['nombre'];

        $pdf->Cell(40,7,'Vacunador:',0,0,'L',0);
        $pdf->Cell(40,7,$nombreVeterinario,0,1,'L',0);
        $pdf->Ln(3);
        $pdf->SetFont('Times','B',11);
        $pdf->SetX(10);
        $pdf->Cell(15,7,'Acta',0,0,'L',0);
        $pdf->Cell(25,7,'Fecha Vac.',0,0,'L',0);
        $pdf->Cell(70,7,'Propietario',0,0,'L',0);
        $pdf->Cell(65,7,'Establecimiento',0,0,'L',0);
        $pdf->Cell(40,7,'Renspa',0,0,'L',0);
        $pdf->Cell(25,7,'Cantidad',0,0,'L',0);
        $pdf->Cell(20,7,'Estado',0,0,'L',0);
        $pdf->Cell(40,7,'Debe',0,1,'L',0);
        $pdf->Cell(278,.5,'',0,1,'L',1);
        $pdf->SetFont('Times','',11);


        $dataPorVacunador = ControladorActas::ctrMostrarActa($item,$matricula);

        $dataCampania = ControladorAftosa::ctrMostrarDatosCampania('numero',$_COOKIE['campania']);

        $totalAnimalesVacunados = 0;

        foreach ($dataPorVacunador as $key => $dataProductor) {

            $item = 'renspa';

            $productor = ControladorProductores::ctrMostrarProductores($item,$dataProductor['renspa']);

            $pdf->Cell(15,7,$dataProductor['acta'],0,0,'L',0);
            $pdf->Cell(25,7,formatearFecha($dataProductor['fechaVacunacion']),0,0,'L',0);
            $pdf->Cell(70,7,$productor['propietario'],0,0,'L',0);
            $pdf->Cell(65,7,$productor['establecimiento'],0,0,'L',0);
            $pdf->Cell(40,7,$dataProductor['renspa'],0,0,'L',0);
            $pdf->Cell(25,7,$dataProductor['cantidadPar'],0,0,'L',0);

            $totalAnimalesVacunados += $dataProductor['cantidadPar'];
            
            $pdf->SetFont('helvetica','B',9);

            if($dataProductor['pago']){

                $pdf->SetTextColor(0,175,12);
                $pdf->Cell(20,7,utf8_decode("Pagó"),0,1,'L',0);
                $pdf->SetFont('times','',11);
                $pdf->SetTextColor(0,0,0);
            
            }else{

                $pdf->SetTextColor(255,0,0);
                $pdf->Cell(20,7,utf8_decode("NO Pagó"),0,0,'L',0);
                $debe = ($dataProductor['cantidadPar'] * $dataCampania['vacunadorA']);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetFont('times','',11);
                $pdf->Cell(40,7,"$ ".number_format($debe, 2, ",", "."),0,1,'L',0);

            }
        }
        
    
        $pdf->SetFont('times','B',11);
        $pdf->Cell(215,7,'',0,0,'L',0);
        $pdf->Cell(20,.5,'',0,1,'L',1);
        $pdf->Cell(215,7,'',0,0,'L',0);
        $pdf->Cell(40,7,$totalAnimalesVacunados,0,1,'L',0);	

        $pdf->Output();

    }

    public function informe4(){

        //REQUERIMOS LA CLASE TCPDF

        include('fpdf.php');

        // ---------------------------------------------------------

        $titulo = 'Detalle de Animales Vacunados por Vacunador con Bufalos/as';

        $cabezera = "Sistema integrado de Vacunación Anti-Aftosa \n Detalle de Animales Vacunados por Vacunador con Bufalos/as";

        include 'cabezeraLand.php';

    }

}


if($informe){

    $informeGeneral = new informePDF();

    if($informe == 'informe3')
        $informeGeneral->matricula = $_GET['matricula'];

    $informeGeneral -> $informe();

}



?>