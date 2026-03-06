<?php
// 1. Base de datos de ejemplo (Array multidimensional)
$suscriptores = [
    ["nombre" => "César", "email" => "cesar@ejemplo.com", "producto"=> "Silla Ergonómica"],
    ["nombre" => "Himi", "email" => "himi@test.es", "producto"=> "Videojuego RPG"],
    ["nombre" => "Luis", "email" => "luis@correo.com", "producto"=> "Pack de DVDs de tu serie favorita"],
    ["nombre" => "David", "email" => "david@correo.com", "producto"=> "Una forma sencilla y cómoda para ganar 1000€ al día sin moverte del sofá"],
    ["nombre" => "Nadine", "email" => "nadine@correo.com", "producto"=> "Un Millón de Dólares"]
];

$asunto = "¡Hola de nuevo! 😎";

// 2. Cabeceras fijas para HTML
$cabeceras  = "MIME-Version: 1.0" . "\r\n";
$cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$cabeceras .= "From: Miguel <miguel@dicampus.es>" . "\r\n";

echo "<h1>Estado del envío masivo</h1>";

// 3. El motor del SPAMMERRRRRR (Bucle foreach)
foreach ($suscriptores as $cliente) {
    $nombre = $cliente['nombre'];
    $destinatario = $cliente['email'];

    // Diseño con CSS Inline para máxima compatibilidad
    $cuerpo = "
    <div style='background-color: #f0f0f0; padding: 40px; font-family: sans-serif;'>
        <div style='background-color: white; 
                    padding: 30px; 
                    border-radius: 15px; 
                    max-width: 500px; 
                    margin: 0 auto; 
                    border: 1px solid #ddd;
                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>
            
            <h2 style='color: #2c3e50;'>¡Hola, $cliente!</h2>
            <p style='color: #7f8c8d; line-height: 1.6; font-size: 16px;'>
                Hemos pensado en tí cuando haciendo limpieza en nuestro almacen, encontramos un exclusivo $producto.
                Al verlo, inmediatamente le dije a mi jefe; esto no se tira, seguro que a $cliente le interesa. Estoy convencido de que no vas a dejar pasar esta oportunidad única $cliente!!
                </p>
            
            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            
            <p style='font-size: 12px; color: #bdc3c7; text-align: center;'>
                Has recibido este correo porque estás en nuestra lista de falsos amigos a los que venderles mierda inutil.
            </p>
        </div>
    </div>
    ";

    // Intentar envío
    if (mail($destinatario, $asunto, $cuerpo, $cabeceras)) {
        echo "<p style='color: green;'>✅ Correo enviado a: <b>$nombre</b> ($destinatario)</p>";
    } else {
        echo "<p style='color: red;'>❌ Error al enviar a: $destinatario</p>";
    }

    // Pequeña pausa para no saturar el servidor de correo
    usleep(500000); // 0.5 segundos
}
?>
