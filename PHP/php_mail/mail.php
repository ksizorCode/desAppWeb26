<h1>Enviador de emails con PHP</h1>
<?php
$para ='cesar@';
$asunto ='Saludos';
$mensaje ='Hola Cesas buenos días. Te escribo para saludarte y decirte hola 😎';
/*
$mensaje ='
<style>.Hoja{ background:grey; padding:20px; border-radius:10px; font-family:sans-serif; max-width:540px;
    margin:20px auto;    }
</style>
<div class="Hoja">
Hola Cesas buenos días. Te escribo para saludarte y decirte hola 😎
</div>';
*/
// 2. Cabeceras necesarias para enviar HTML
$cabeceras  = "MIME-Version: 1.0" . "\r\n";
$cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$cabeceras .= "From: Miguel <miguel@dicampus.es>" . "\r\n";


if(mail($para, $asunto,$mensaje, $cabeceras)) {
    echo "El correo ha sido enviado correctamente";
} else {
    echo "El envio ah fallado";
}




/*
SPAMMERRRRRR!!!!!!

Haz un sistema para enviar correo masivamente a una lista de usuarios:
- que aparezca su nombre en el correo
- que el correo se vea bonito (integrar html y css)


*/

?>
