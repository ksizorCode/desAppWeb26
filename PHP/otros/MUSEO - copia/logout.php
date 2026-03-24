<? require 'bloques/config.php'; ?>

<?php
_session_logueado();
session_unset();     // Vaciar las variables de sesión
session_destroy();   // Destruimos la sesión
$logueado=false;
?>

<? include 'bloques/header.php'; ?>
<h1>La sesión se ha cerrado correctamente</h1>
<p>Puede volver a acceder en <a href="login.php">Login</a>.

<? include 'bloques/footer.php'; ?>

//