<h1>Comprobar</h1>
<a href="index.php">Volver al Index</a>

<?php

session_start();

if(isset($_SESSION['usuario'])){
    echo "<h2>La sesión se ha iniciado correctamente</h2>";
    echo "La sesión usuario es igual a: {$_SESSION['usuario']}";
}
else{
    echo "<h2>NO hay sesión iniciada</h2>";
}