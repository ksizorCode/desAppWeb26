<h1>Cerrar Sesión</h1>
<a href="index.php">Volver al Index</a>

<?php

session_start();

session_unset(); //elimina las posibles variables creadas (usuario)
session_destroy();//destruye la sesión

echo "La Sesión se ha eliminado.";