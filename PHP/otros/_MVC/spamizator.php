

<?php
$clientes = [
    ["nombre" => "Juan Pérez", "email" => "juan.perez@example.com"],
    ["nombre" => "María López", "email" => "maria.lopez@example.com"],
    ["nombre" => "Carlos García", "email" => "carlos.garcia@example.com"],
    ["nombre" => "Ana Fernández", "email" => "ana.fernandez@example.com"],
    ["nombre" => "Luis Rodríguez", "email" => "luis.rodriguez@example.com"],
    ["nombre" => "Pedro Sánchez", "email" => "pedro.sanchez@example.com"],
    ["nombre" => "Laura Gómez", "email" => "laura.gomez@example.com"],
    ["nombre" => "David Martín", "email" => "david.martin@example.com"],
    ["nombre" => "Elena Torres", "email" => "elena.torres@example.com"],
    ["nombre" => "José Ramírez", "email" => "jose.ramirez@example.com"],
    ["nombre" => "Sofía Navarro", "email" => "sofia.navarro@example.com"],
    ["nombre" => "Manuel Ortega", "email" => "manuel.ortega@example.com"],
    ["nombre" => "Beatriz Castro", "email" => "beatriz.castro@example.com"],
    ["nombre" => "Ricardo Díaz", "email" => "ricardo.diaz@example.com"],
    ["nombre" => "Natalia Herrera", "email" => "natalia.herrera@example.com"],
    ["nombre" => "Alberto Molina", "email" => "alberto.molina@example.com"],
    ["nombre" => "Marta Ríos", "email" => "marta.rios@example.com"],
    ["nombre" => "Francisco Vega", "email" => "francisco.vega@example.com"],
    ["nombre" => "Carmen Ruiz", "email" => "carmen.ruiz@example.com"],
    ["nombre" => "Hugo Giménez", "email" => "hugo.gimenez@example.com"],
    ["nombre" => "Isabel Santos", "email" => "isabel.santos@example.com"],
    ["nombre" => "Gabriel Mendoza", "email" => "gabriel.mendoza@example.com"],
    ["nombre" => "Patricia León", "email" => "patricia.leon@example.com"],
    ["nombre" => "Diego Cabrera", "email" => "diego.cabrera@example.com"],
    ["nombre" => "Andrea Vargas", "email" => "andrea.vargas@example.com"]
];

$asuntos = [
    "🔥 ¡Oferta exclusiva solo por HOY!",
    "🎁 ¡Has sido seleccionado para un regalo especial!",
    "💰 ¡Gana dinero fácil desde casa!",
    "🚀 ¡Tu cuenta ha sido aprobada para beneficios VIP!",
    "😱 ¡No creerás esta oferta limitada!",
    "⏳ Última oportunidad: 90% de descuento",
    "🎉 ¡Felicitaciones! Has sido elegido",
    "💎 ¡Acceso exclusivo a nuestra promoción secreta!",
    "📢 ¡URGENTE! Reclama tu premio ahora",
    "💼 ¡Trabaja menos y gana más!",
    "🤑 ¡Solo HOY! Duplica tu dinero en minutos",
    "💳 ¡Tu tarjeta de crédito ha sido preaprobada!",
    "🔑 ¡Desbloquea este descuento especial!",
    "🎯 ¡Esta oportunidad es solo para ti!",
    "🆓 ¡Prueba gratis por tiempo limitado!",
    "🏆 ¡Eres el ganador de nuestro sorteo!",
    "📦 ¡Tu paquete está listo para ser enviado!",
    "💡 ¡Descubre el secreto de los millonarios!",
    "🔥 ¡Esta oferta se acaba en pocas horas!",
    "👀 ¡No ignores este mensaje importante!",
    "🎈 ¡Celebra con nosotros y obtén un regalo!",
    "🔔 ¡Aviso de seguridad! Verifica tu cuenta ahora",
    "🏝️ ¡Vacaciones GRATIS! Solo por registrarte",
    "📢 ¡Oferta exclusiva para los primeros 100 clientes!",
    "🔓 ¡Tu cuenta ha sido desbloqueada con éxito!"
];

for($i=0;$i<1000;$i++){



// Genera un numero aleatorio
$indiceAleatorio = rand(0, count($clientes) - 1);



//Sacar datos de la base de datos
$nombre = $clientes[$indiceAleatorio]['nombre'];
$email = $clientes[$indiceAleatorio]['email'];

$fecha = date('l, j \d\e F \d\e Y \a \l\a\s H:i'); // Día de la semana, día del mes, mes, año, hora:minutos


//teste email
$to = $email;
$subject = $asuntos[array_rand($asuntos)];
$msg = "<style> body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}
.container {
    max-width: 600px;
    background: white;
    margin: 20px auto;
    padding: 20px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}
h1 {
    color: #e60000;
}
.highlight {
    color: #ff9900;
    font-weight: bold;
}
.cta-button {
    display: inline-block;
    background-color: #ff6600;
    color: white;
    padding: 15px 25px;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    border-radius: 5px;
    margin-top: 20px;
}
.cta-button:hover {
    background-color: #cc5500;
}
.footer {
    margin-top: 20px;
    font-size: 12px;
    color: #666;
}</style>
<div class='container'>
<img src='data:image/webp;base64,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'>
<h1>🚀 ¡ATENCIÓN $nombre! 🚀</h1>
<p>¿Te gustaría tener <span class='highlight'>la moto de tus sueños</span> sin pagar una fortuna?</p>
<p>Por tiempo limitado, estamos ofreciendo descuentos de hasta el <strong>90%</strong> en nuestra gama de motocicletas premium. ¡No dejes pasar esta oportunidad única!</p>
<a href='https://oferta-falsa.com?pringado=$nombre' class='cta-button'>¡Reserva la tuya ahora!</a>
<p class='footer'>*Oferta válida solo por 24 horas. Aplican términos y condiciones.</p>
<footer>
Email enviado a $email el día $fecha
</footer>
</div>
";

$headers = "From: tuemail@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";




    mail($to, $subject, $msg, $headers);
} // fin de for