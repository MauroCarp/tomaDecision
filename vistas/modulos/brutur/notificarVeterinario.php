<?php
echo "<h3>Enviando E-Mail...";

include '../../../controladores/brutur.controlador.php';
include '../../../modelos/brutur.modelo.php';

include '../../../controladores/productores.controlador.php';
include '../../../modelos/productores.modelo.php';

include '../../../controladores/veterinarios.controlador.php';
include '../../../modelos/veterinarios.modelo.php';


$descargarExcel = new ControladorBruTur();
$descargarExcel -> ctrNotificar();


echo "<script>

setTimeout(function(){
    window.close();
},500)

</script>";
?>