<?php

require_once "../../controladores/brucelosis.controlador.php";
require_once " ../../../../modelos/brucelosis.modelo.php";
require_once "../../controladores/tuberculosis.controlador.php";
require_once " ../../../../modelos/tuberculosis.modelo.php";
require_once "../../controladores/veterinarios.controlador.php";
require_once " ../../../../modelos/veterinarios.modelo.php";
require_once "../../controladores/productores.controlador.php";
require_once " ../../../../modelos/productores.modelo.php";

function formatearFecha($fecha){

    $fechaExplode = explode('-',$fecha);
  
    $fechaFormateada = $fechaExplode[2]."-".$fechaExplode[1]."-".$fechaExplode[0];
  
    return $fechaFormateada;
  }

$accion = $_GET['accion'];

class GenerarPDF{

  public $rango;

  public function informeEstablecimientosSD(){

    include('fpdf.php');

    $item = "estado";

    $valor = "S/D";

    $rango = $this->rango;

    $respuesta = ControladorBrucelosis::ctrMostrarSD($item, $valor,$rango);

    $pdf = new FPDF('P','mm','A4');	
    $pdf->AddPage();
    $pdf->SetFillColor(0,255,0);
    $pdf->SetTitle('Informe Entes Brucelosis');
    $pdf->SetDisplayMode('fullpage', 'single');
    $pdf->SetAutoPageBreak(1,1);
    $pdf->Image('img/logo-fissa.png', 15, 10,40);
    $pdf->SetFont('helvetica','B',16);
    $pdf->Ln(6);
    $pdf->SetX(60);
    $pdf->Cell(50,7,'Establecimientos SIN DATOS',0,0,'L',0);
    $pdf->Ln(25);
    $pdf->Cell(22);
    $pdf->SetFont('Times','B',12);
    $pdf->SetX(10);
    $pdf->Cell(8,7,utf8_decode('N°'),0,0,'L',0);
    $pdf->Cell(30,7,'Renspa',0,0,'L',0);
    $pdf->Cell(130,7,'Propietario',0,0,'L',0);
    $pdf->Cell(40,7,'Fecha de Status',0,1,'L',0);
    $pdf->SetFont('Times','',10);

    for ($i=0; $i < sizeof($respuesta) ; $i++) { 

      $num = $i + 1;

      $pdf->Cell(8,7,$num,0,0,'L',0);
      $pdf->Cell(30,7,$respuesta[$i]['renspa'],0,0,'L',0);
      $pdf->Cell(130,7,$respuesta[$i]['propietario'],0,0,'L',0);
      $pdf->Cell(40,7,formatearFecha($respuesta[$i]['fechaSD']),0,1,'L',0);

    }


    $pdf->Output();

  }



  public function informeGeneral(){

    //REQUERIMOS LA CLASE TCPDF

    include('fpdf.php');

    $rango = $this->rango;

    $rangoExp = explode('/',$rango);

    $fechaDesde = formatearFecha($rangoExp[0]);

    $fechaHasta = formatearFecha($rangoExp[1]);

    // ---------------------------------------------------------

    /*BRUCELOSIS*/

    // CANTIDAD DE ESTABLECIMIENTOS
    $item = 'estado';

    $valor = 'Saneado';

    $valor2 = null;

    $item2 = 'fechaSaneado';

    $cantEstSaneado = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango,null);

    $valor = 'En Saneamiento';

    $item2 = 'fechaSaneamiento';

    $cantEstSaneamiento = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango,null);

    $valor = 'S/D';

    $item2 = 'fechaSD';

    $cantEstSD = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango,null);

    $valor = '0';

    $item = 'positivo';

    $cantEstPositivos = ControladorBrucelosis::ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,null);

    $item = 'negativo';

    $cantEstNegativos = ControladorBrucelosis::ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,null);

    $item = 'sospechoso';

    $cantEstSospechosos = ControladorBrucelosis::ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,null);

    // CANTIDAD DE ANIMALES
    $item = 'positivo';

    $cantAnimalesPositivos = ControladorBrucelosis::ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,'sumar');

    $item = 'negativo';

    $cantAnimalesNegativos = ControladorBrucelosis::ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,'sumar');

    $item = 'sospechoso';

    $cantAnimalesSospechosos = ControladorBrucelosis::ctrContarSumarRegistrosPosNegSos($item,$valor,$item2,$rango,'sumar');

    $item = 'estado';

    $valor = 'En Saneamiento';

    $valor2 = null;

    $item2 = 'fechaSaneamiento';

    $cantAnimalesSaneamiento = ControladorBrucelosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$rango);

    $valor = 'Saneado';

    $item2 = 'fechaSaneado';

    $cantAnimalesSaneados = ControladorBrucelosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$rango);

    $valor = 'S/D';

    $item2 = 'fechaSD';

    $cantAnimalesSD = ControladorBrucelosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$rango);

    // CANTIDAD DE ESTABLECIMIENTOS LIBRES
    $valor = 'Libre';

    $valor2 = 'RecertificaciÃ³n';

    $item2 = 'fechaLibre';

    $cantUPLibres = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango);

    $item2 = 'fechaCarga';

    $cantUPLibresCargadas = ControladorBrucelosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango);

    // CANTIDAD DE ANIMALES LIBRES
    $item2 = 'fechaLibre';

    $cantAnimalesLibres = ControladorBrucelosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$rango);


    /*TUBERCULOSIS*/

    $item = 'estado';

    $valor = 'En Saneamiento';

    $valor2 = 'Libre';

    $item2 = 'fechaLibre';

    $item3 = 'fechaSaneamiento';

    $cantAnimalesTuberculinizados = ControladorTuberculosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$item3,$rango);

    // var_dump($cantAnimalesTuberculinizados);

    $valor = 'Libre';

    $valor2 = null;

    $item2 = 'fechaLibre';

    $item3 = null;

    $cantAnimalesLibresTuberculinizados = ControladorTuberculosis::ctrSumarRegistros($item,$valor,$valor2,$item2,$item3,$rango);

    // CONTAR ESTABLECIMIENTOS LIBRES

    $valor = 'Libre';

    $valor2 = 'RecertificaciÃ³n';

    $item2 = 'fechaLibre';

    $cantEstLibres = ControladorTuberculosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango);

    $item2 = 'fechaCarga';

    $cantEstLibresCargados = ControladorTuberculosis::ctrContarRegistros($item,$valor,$valor2,$item2,$rango);

    $titulo = 'Informe Entes Brucelosis-Tuberculosis';

    $cabezera = 'Informe Entes Brucelosis-Tuberculosis';

    include 'cabezera.php';

    $pdf->Cell(200,7,'Periodo: '.date("d-m-Y", strtotime($fechaDesde)). ' al '.date("d-m-Y", strtotime($fechaHasta)),0,0,'C',0);

    $pdf->SetFont('helvetica','B',12);
    /*AGREGAR PERIODO*/
    $pdf->Ln(22);
    $pdf->SetX(10);
    $pdf->Cell(190,0.1,'',0,1,'',1);
    $pdf->Ln(5);
    $pdf->SetFillColor(255,255,204);
    $pdf->Cell(190,7,'BRUCELOSIS',1,1,'C',1);
    $pdf->SetFont('helvetica','',12);
    $pdf->Cell(180,7,'Cantidad de Establecimientos en Saneamiento:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstSaneamiento[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos Saneados:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstSaneado[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos S/D Acumulado:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstSD[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos con A. Positivos:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstPositivos[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos con A. Negativos:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstNegativos[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos con A. Sospechosos:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstSospechosos[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales Positivos:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesPositivos[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales Negativos:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesNegativos[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales Sospechosos:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesSospechosos[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales en Saneamiento:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesSaneamiento[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales Saneados:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesSaneados[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales S/D:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesSD[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de U.P Libres Certificadas en el Mes:',1,0,'L',0);
    $pdf->Cell(10,7,$cantUPLibres[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de U.P Libres Certificadas CARGADAS en el Mes:',1,0,'L',0);
    $pdf->Cell(10,7,$cantUPLibresCargadas[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales Libres Total:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesLibres[0][0],1,1,'C',0);

    $pdf->Ln(5);
    $pdf->SetFont('helvetica','B',12);
    $pdf->SetFillColor(204,255,229);
    $pdf->Cell(190,7,'TUBERCULOSIS',1,1,'C',1);
    $pdf->SetFont('helvetica','',12);
    $pdf->Cell(180,7,'Cantidad de Animales Tuberculinizados:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesLibresTuberculinizados[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Animales Libres Tuberculinizados:',1,0,'L',0);
    $pdf->Cell(10,7,$cantAnimalesLibresTuberculinizados[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos Libres Certificados:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstLibres[0][0],1,1,'C',0);
    $pdf->Cell(180,7,'Cantidad de Establecimientos Libres Certificados CARGADOS:',1,0,'L',0);
    $pdf->Cell(10,7,$cantEstLibresCargados[0][0],1,1,'C',0);

    $pdf->Output();

  }

  public function statusVeterinario(){

    //REQUERIMOS LA CLASE TCPDF

    include('fpdf.php');

    // ---------------------------------------------------------

    $titulo = 'Status Sanitario de Establecimientos por Veterinario';

    $cabezera = 'Status Sanitario por Veterinario';
    
    include 'cabezera.php';

    $pdf->Ln(25);
    $pdf->Cell(210,0.1,'',0,1,'L',1);
    $pdf->SetFont('Times','B',12);
    $pdf->SetX(10);
    $pdf->Cell(50,7,'Veterinario',0,0,'L',0);
    $pdf->Cell(60,7,'Propietario',0,0,'L',0);
    $pdf->Cell(40,7,'Estado Brucelosis',0,0,'L',0);
    $pdf->Cell(50,7,'Estado Tuberculosis',0,1,'L',0);
    $pdf->SetFont('Times','',10);

    $item = null;

    $valor = null;

    $veterinarios = ControladorVeterinarios::ctrMostrarVeterinarios($item,$valor);
    for ($i=0; $i < sizeof($veterinarios) ; $i++) { 

      $matricula = $veterinarios[$i]['matricula'];

      $nombre = $veterinarios[$i]['nombre'];

      $item = 'veterinario';
      
      $statusEstablecimiento = ControladorProductores::ctrStatusEstablecimientos($item,$matricula);
      
      if(!empty($statusEstablecimiento)){
        $pdf->SetX(10);
        $pdf->Cell(50,7,$nombre,0,0,'L',0);
        
        for ($a=0; $a < sizeof($statusEstablecimiento) ; $a++) { 
          
          $pdf->SetX(10);
          $pdf->Cell(50,7,'',0,0,'L',0);
          $pdf->Cell(60,7,$statusEstablecimiento[$a]['establecimiento'],0,0,'L',0);
          $pdf->Cell(40,7,$statusEstablecimiento[$a]['estadoBrucelosis'],0,0,'L',0);
          $pdf->Cell(50,7,$statusEstablecimiento[$a]['estadoBrucelosis'],0,1,'L',0);

        }
        
      }

    }


    $pdf->Output();

  }

}

if($accion == 'establecimientosSD'){

    $establecimientosSD = new GenerarPDF();
    $establecimientosSD -> rango = $_GET["rango"];
    $establecimientosSD -> informeEstablecimientosSD();

}

if($accion == 'informeGeneral'){

    $informeGeneral = new GenerarPDF();
    $informeGeneral -> rango = $_GET["rango"];
    $informeGeneral -> informeGeneral();

}

if($accion == 'statusVeterinario'){

    $statusVeterinario = new GenerarPDF();
    $statusVeterinario -> statusVeterinario();

}

?>