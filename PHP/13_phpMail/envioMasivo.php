<?php
// 1. Catálogo de Productos (Base de datos de stock)
$catalogo = [
    "silla_Egok-R5800" => ["titulo" => "Silla Ergonómica", "url_img" => "https://www.ofiprecios.com/wp-content/uploads/2023/11/Black-8-800x798.jpg"],
    "VideogameRPG"     => ["titulo" => "Videojuego RPG", "url_img" => "https://www.muycomputer.com/wp-content/uploads/2020/04/juegos-de-PS5-4.jpg"],
    "DVDs007"     => ["titulo" => "Pack de DVDs Serie", "url_img" => "https://static.fnac-static.com/multimedia/Images/ES/NR/f4/19/06/399860/1540-6/tsp20160822171544/Pack-James-Bond-007-Coleccion-completa-DVD.jpg"],
    "milEuros"         => ["titulo" => "Plan Maestro de Ingresos", "url_img" => "https://thumbs.dreamstime.com/z/mont%C3%B3n-del-dinero-23622650.jpg?ct=jpeg"],
    "millonEuros"      => ["titulo" => "Un Millón de Dólares", "url_img" => "https://thumbs.dreamstime.com/z/mont%C3%B3n-del-dinero-23622650.jpg?ct=jpeg"]
];

// 2. Base de Datos de Clientes (con referencia al producto por su 'ID' o clave)
$suscriptores = [
    ["nombre" => "César", "email" => "cesar@ejemplo.com",   "interes" => "silla_Egok-R5800"],
    ["nombre" => "Himi",  "email" => "himi@test.es",        "interes" => "VideogameRPG"],
    ["nombre" => "Luis",  "email" => "luis@correo.com",     "interes" => "DVDs007"],
    ["nombre" => "David", "email" => "david@correo.com",    "interes" => "milEuros"],
    ["nombre" => "Nadine","email" => "nadine@correo.com",   "interes" => "millonEuros"],

    ["nombre" => "Oscar", "email" => "oscar@correo.com",    "interes" => "milEuros"],
    ["nombre" => "Roman", "email" => "roman@correo.com",    "interes" => "VideogameRPG"],
    ["nombre" => "J.Manu", "email" => "jmanu@correo.com",   "interes" => "DVDs007"],
    ["nombre" => "Adalid","email" => "adalid@correo.com",   "interes" => "silla_Egok-R5800"],
    ["nombre" => "Sergio","email" => "sergio@correo.com",   "interes" => "millonEuros"]
];

$cabeceras  = "MIME-Version: 1.0" . "\r\n";
$cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$cabeceras .= "From: Miguel <miguel@dicampus.es>" . "\r\n";

echo "<h1>Estado del envío masivo personalizado</h1>";

foreach ($suscriptores as $cliente) {
    // 3. Cruzamos los datos: obtenemos el producto basándonos en el interés del cliente
    $id_producto = $cliente['interes'];
    $producto_info = $catalogo[$id_producto];
    
    $nombre = $cliente['nombre'];
    $email  = $cliente['email'];
    $titulo_prod = $producto_info['titulo'];
    $imagen_prod = $producto_info['url_img'];

    $asunto ="😎 Mira lo que hemos encontrado para ti, $nombre!!";

    $cuerpo = "
    <div style='background-color: #f0f0f0; padding: 40px; font-family: sans-serif;'>
        <div style='background-color: white; padding: 30px; border-radius: 15px; max-width: 500px; margin: 0 auto; border: 1px solid #ddd; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>
            
            <h2 style='color: #2c3e50;'>¡Hola, $nombre!</h2>
            <p style='color: #7f8c8d; line-height: 1.6;'>
                Haciendo limpieza en nuestro almacén, encontramos un exclusivo <strong>$titulo_prod</strong>. 
                Inmediatamente pensé: <em>'Esto le va a encantar a $nombre'</em>.
            </p>

            <div style='text-align: center; margin: 20px 0;'>
                <img src='$imagen_prod' alt='$titulo_prod' style='width: 100%; max-width: 300px; border-radius: 10px;'>
            </div>
            
            <div style='text-align: center; margin: 30px 0;'>
                <a href='#' style='background-color: #e74c3c; color: white; padding: 15px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;'>¡LO QUIERO YA!</a>
            </div>

            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            <p style='font-size: 11px; color: #bdc3c7; text-align: center;'>
                Oferta exclusiva para $nombre. No la compartas.
            </p>
        </div>
    </div>
    ";

    echo '<ul>';
    if (mail($email, $asunto, $cuerpo, $cabeceras)) {
        echo "<li style='color: green;'>✅ Enviado a: <b>$nombre</b>. Interesado en: $titulo_prod                 <img src='$imagen_prod' alt='$titulo_prod' style='width: 30px; border-radius: 5px;'></li>";
        }
    else {
            echo "<li style='color: red;'>❌ Fallo al enviar a: $email</li>";
        }
echo '</ul>';

// Esperar medio segundo
usleep(500000);
}
?>
