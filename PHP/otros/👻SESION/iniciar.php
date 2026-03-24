<h1>Iniciar Sesión</h1>
<a href="index.php">Volver al Index</a>


<?php

session_start(); // abrimos el "libro" o sistema de sesiones
$_SESSION['usuario'] ="Pepito";
$_SESSION['rol'] ="administrador";

echo "<p>La sesión se ha iniciado para {$_SESSION['usuario']}</p>";

?>