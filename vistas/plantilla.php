<?php

session_start();

$logo = 'tomaDecision';

function formatearFecha($fecha){

  $fechaExplode = explode('-',$fecha);

  $fechaFormateada = $fechaExplode[2]."-".$fechaExplode[1]."-".$fechaExplode[0];

  return $fechaFormateada;

}


function encrypt_decrypt($action, $string){

  $output = false;

  $encrypt_method = "AES-256-CBC";

  $secret_key = 'WS-SERVICE-KEY';

  $secret_iv = 'WS-SERVICE-VALUE';
  // hash
  $key = hash('sha256', $secret_key);
  // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning

  $iv = substr(hash('sha256', $secret_iv), 0, 16);

  if ($action == 'encrypt') {

      $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));

  } else {

      if ($action == 'decrypt') {

          $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

      }

  }

  return $output;

}

function desactivarCarpetas(){

  $today = date('Y-m-d');

  $item = 'activa';

  $valor = 1;

  $carpetas = ControladorCarpetas::ctrMostrarCarpetasNoToday($item,$valor,$today);
  
  foreach ($carpetas as $key => $carpeta) {
    
    $item = 'idCarpeta';

    $valor = $carpeta['idCarpeta'];

    $datos = 'desactivar';

    $desactivarCarpeta = ControladorCarpetas::ctrEditarCarpeta($item, $valor,$datos);

  }

}

$today = date('Y-m-d');

if(isset($_COOKIE['fecha'])){

  if($_COOKIE['fecha'] != $today){

    desactivarCarpetas();

    setcookie("fecha", $today);

  }

}else{

  setcookie("fecha", $today);
  
  desactivarCarpetas();

}

?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Toma de Decision Animal</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">

   <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- ESTILOS PROPIOS -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Icomoon -->
  <link rel="stylesheet" href="vistas/bower_components/icomoon/css/icomoon.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/s.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

   <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Morris chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">

  <!-- Sweet ALert 2 -->
  <link rel="stylesheet" href="vistas/plugins/sweetalert2/sweetalert2.min.css">


  <!-- ESTILOS PROPIOS -->
  <link rel="stylesheet" href="vistas/dist/css/styles.css">

  <!-- Sliders/-->
  <link  rel="stylesheet" src="vistas/plugins/bootstrap-slider/slider.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.3/js/dataTables.rowGroup.min.js"></script>

  
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <!-- <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script> -->
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.js"></script>
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

   <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="vistas/bower_components/chartjs/dist/chart.min.js"></script>
  <script src="vistas/bower_components/chartjs/dist/chartjs-plugin-datalabels.js"></script>

  <!-- Sliders/-->
  <script src="vistas/plugins/bootstrap-slider/bootstrap-slider.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

  <!-- <script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.js"></script> -->

</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue sidebar-mini login-page sidebar-collapse">
 
  <?php

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

    include "cuerpo.php";


  }else if( isset($_COOKIE['rememberme']  )){
    
    $userid = encrypt_decrypt('decrypt',$_COOKIE['rememberme']);
            
    $item = 'id';
    
    $count = ControladorUsuarios::ctrContarUsuarios($item,$userid);

    if( $count > 0 ){

      $user = ControladorUsuarios::ctrMostrarUsuarios($item,$userid);

        $_SESSION['id'] = $userid; 
        $_SESSION["iniciarSesion"] = "ok";
        $_SESSION["nombre"] = $user["nombre"];
        $_SESSION["usuario"] = $user["usuario"];
        $_SESSION["foto"] = $user["foto"];
        $_SESSION["perfil"] = $user["perfil"];
       
        include "cuerpo.php";

    }

 }else{

    include "modulos/login.php";

  }

  ?>


<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/inicio.js"></script>
<script src="vistas/js/animales.js"></script>
<script src="vistas/js/carpetas.js"></script>
<script src="vistas/js/clasificacion.js"></script>
<script src="vistas/js/sliders.js"></script>
<script src="vistas/js/perfiles.js"></script>
<script src="vistas/js/analisis.js"></script>
<script src="vistas/js/usuarios.js"></script>

</body>
</html>
