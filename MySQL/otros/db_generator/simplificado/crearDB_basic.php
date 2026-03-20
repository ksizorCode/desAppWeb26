
<?php

// VARIABLES CON LOS DATOS QUE VAMOS A USAR
$dbHost="localhost";    //host
$dbUser="root";         // usuario
$dbPass="root";         //Contraseña de acceso a la BD
$dbName="casa";         //Nombre de la base de datos

// - - - - - - - NO PUEDES TOCAR
// crear conexión de la base de datos
$conn=mySqli_connect($dbHost, $dbUser, $dbPass);

// verificamos la conexión 
if(!$conn){
    die("conexión fallida: " . mysqli_connect_error());
}
echo "conexión exitosa";


// crear la base de datos

$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if(mysqli_query($conn, $sql)){
    echo "base de datos creada exitosamente";
}
else{
    echo "base de datos no creada";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ElmaDB</h1>



</body>
</html>