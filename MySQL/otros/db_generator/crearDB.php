
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>ElmaDB</h1>


<?php
//comprobamos que recibimos datos 
if(isset($_GET['nombre'],$_GET['host'],$_GET['password'],$_GET['usuario']))
{
        $dbHost = $_GET['host'];
        $dbUser = $_GET['usuario'];
        $dbPass = $_GET['password'];
        $dbName = $_GET['nombre'];

        // // VARIABLES CON LOS DATOS QUE VAMOS A USAR
        // $dbHost="localhost";    //host
        // $dbUser="root";         // usuario
        // $dbPass="root";         //Contraseña de acceso a la BD
        // $dbName="pastelma";         //Nombre de la base de datos


        // crear conexión de la base de datos
        $conn=mySqli_connect($dbHost, $dbUser, $dbPass);

        // verificamos la conexión 
        if(!$conn){
            die("conexión fallida: " . mysqli_connect_error());
        }
        echo "<p>conexión exitosa</p>";


        // crear la base de datos

        $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
        if(mysqli_query($conn, $sql)){
            echo "<p>Base de datos <strong>$dbName</strong> ha sido creada exitosamente</p>";
            echo "<p>Haga click aquí para: <a href='index.php'>Crear otra base de datos</a></p>";
        }
        else{
            echo "base de datos no creada";
        }
}
else{  
    ?>
   
    <form action="">
        <label for="host">Servidor DB:</label>
        <input type="text" id="host" name="host" value="localhost" required>
        
        <label for="usuario">Usuario DB:</label>
        <input type="text" id="usuario" name="usuario" value="root" required>
        
        <label for="password">Password DB:</label>
        <input type="text" id="password" name="password" value="root" required>
        
        <label for="nombre">Nombre DB:</label>
        <input type="text" id="nombre" name="nombre" placeholder="escriba aquí" required>

        <input type="submit" value="Crear Base Datos">
    </form>

<?php
}
?>




</body>
</html>