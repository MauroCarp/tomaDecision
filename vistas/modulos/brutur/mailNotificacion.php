<?php

include("vistas/modulos/brutur/sendmail.php");//Mando a llamar la funcion que se encarga de enviar el correo electronico
//Configuracion de variables para enviar el correo*//*
define('MAIL','pruebafissa@gmail.com');

define('PASS','mauro425336');

$mail_username = MAIL;//Correo electronico saliente ejemplo: tucorreo@gmail.com

$mail_userpassword = PASS;//Tu contraseña de gmail

$mail_addAddress = $emailVeterinario;//correo electronico que recibira el mensaje

$template = "vistas/modulos/brutur/email_template.html";//Ruta de la plantilla HTML para enviar nuestro mensaje

/*Inicio captura de datos enviados por $_POST para enviar el correo */

$mail_setFromEmail= "fundacioniriondosur@gmail.com";

$mail_setFromName= "F.I.S.S.A";

if ($alerta == "porVencer") {
   
    $txt_message="<br><h1>Tuberculosis</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta por vencer su condici&oacute;n de LIBRE. Por favor comunicarse con el propietario para dar aviso.";
   
    if ($tabla == "brucelosis")
        $txt_message="<br><h1>Brucelosis</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta por vencer su condici&oacute;n de LIBRE. Por favor comunicarse con el propietario para dar aviso.";
      
}

if ($alerta == "vencido") {

    $txt_message="<br><h1>Tuberculosis</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta VENCIDO en su condici&oacute;n de LIBRE. Por favor comunicarse con el propietario para dar aviso.";
    
    if ($tabla == "brucelosis")
        $txt_message = "<br><h1>Brucelosis</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta VENCIDO en su condici&oacute;n de LIBRE. Por favor comunicarse con el propietario para dar aviso.";
    
} 

$mail_subject="Aviso de Vencimiento";



if ($alerta == "cambioStatus") {
    
    $bruceTxt = "La certificaci&oacute;n tiene una validez de 365 d&iacute;as para Tambo y Caba&ntilde;a. Y de 730 d&iacute;as para Cr&iacute;a.";
    $tuberTxt = "La certificaci&oacute;n tiene una validez de 365 d&iacute;as.";

    if($campania == 'bruTur'){

        $campanias = array('Brucelosis','Tuberculosis');

        for ($i=0; $i < 1 ; $i++) { 

            $validez = ($campanias[$i] == "Brucelosis") ? $bruceTxt : $tuberTxt;
            
            if ($estado == "En Saneamiento") {
                
                $txt_message = "<h1>".$campanias[$i]."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta en Saneamiento. Dentro de los 90 - 120 d&iacute;as, deber&aacute; realizar un nuevo an&aacute;lisis para estar en condici&oacute;n de libre.";
            }
            if ($estado == "Saneado") {
                $txt_message = "<h1>".$campanias[$i]."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta Saneado. Dentro de los 365 d&iacute;as, deber&aacute; realizar un nuevo an&aacute;lisis para pedir Certificaci&oacute;n de Libre.<br>";
            }
            if ($estado == "Libre" OR $estado == "Recertificación") {
                $txt_message = "<h1>".$campanias[$i]."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta Libre de ".$campanias[$i]." ".$validez;
            }
            
            if ($estado == "No Libre") {

                $txt_message = "<h1>".ucfirst($campania)."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta Libre de ".ucfirst($campania);
    
            }
        }

    }else{

        $validez = ($campania == "brucelosis") ? $bruceTxt : $tuberTxt;
            
        if ($estado == "En Saneamiento") {
            
            $txt_message = "<h1>".ucfirst($campania)."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta en Saneamiento. Dentro de los 90 - 120 d&iacute;as, deber&aacute; realizar un nuevo an&aacute;lisis para estar en condici&oacute;n de libre.";

        }

        if ($estado == "Saneado") {

            $txt_message = "<h1>".ucfirst($campania)."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta Saneado. Dentro de los 365 d&iacute;as, deber&aacute; realizar un nuevo an&aacute;lisis para pedir Certificaci&oacute;n de Libre.<br>";

        }
       
        if ($estado == "Libre" OR $estado == "Recertificacion") {

            $txt_message = "<h1>".ucfirst($campania)."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta Libre de ".ucfirst($campania).".  ".$validez;

        }
       
        if ($estado == "No Libre") {

            $txt_message = "<h1>".ucfirst($campania)."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta Libre de ".ucfirst($campania);

        }

    }

    $mail_subject="Aviso de Actualizacion de Status Sanitario";
    
} 

sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject,$template);

?>