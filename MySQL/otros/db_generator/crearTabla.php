
<?php

// VARIABLES CON LOS DATOS QUE VAMOS A USAR
$dbHost="localhost";    //host
$dbUser="root";         // usuario
$dbPass="root";         //Contraseña de acceso a la BD
$dbName="dicampus_gestion";         //Nombre de la base de datos

// - - - - - - - NO PUEDES TOCAR
// crear conexión de la base de datos
$conn=mySqli_connect($dbHost, $dbUser, $dbPass,$dbName);

// verificamos la conexión 
if(!$conn){
    die("conexión fallida: " . mysqli_connect_error());
}
echo "conexión exitosa";


// crear la base de datos

$sql = "CREATE TABLE `tabla1` (
    `id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre` varchar(255) NOT NULL,
    `img` varchar(255) NULL,
    `texto` text NULL,
    `fecha` date NULL,
    `categoria` varchar(255) NULL,
    `activo` int NULL
  );";
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