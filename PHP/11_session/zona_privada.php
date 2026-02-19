<?php
session_start();

// Si la sesión usuario no existe o no es igual a Bilbo
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'Bilbo') {
    // Redirigir a index
    header("Location: no_puedes_pasar.php");
    // Detener el script por completo
    exit(); 
}

?>


<h1>Estas en una zona super secreta y privada</h1>
<p>Los papeles de Super Secretos</p>

<img src="img/secret.webp" alt="">


<a href="index.php">⬅ Volver al Inicio </a>
