<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dicampus</title>
    <style>
        body{ max-width:960px; margin: 10px auto; font-family: sans-serif; padding:10px;}
        img{
            max-width:100%;
            aspect-ratio:1/1;
            border-radius:50%;
        }
        ul{
            list-style:none;
            padding-left:0;

            display:flex;
            flex-wrap:wrap;
            gap:6px;
        }

        li{
            flex: 1 1 90px;
            padding:10px;
            border-radius:10px;
            border: grey solid 1px;
        }

        </style>
</head>
<body>
    <a href='insertar.php'>insertar </a>
    
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "dicampus";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM Alumnos";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  echo "<ul>";
  while($row = mysqli_fetch_assoc($result)) {
    echo "
    <li>
        <img src='img/{$row['img']}'>
        <p>{$row['nombre']} {$row['apellido']}</p>
    </li>";
  }
  echo "</ul>";
} else {
  echo "0 alumnos";
}

mysqli_close($conn);
?>


</body>
</html>



<?php


/*


CREATE TABLE `alumnos` (
  `id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NULL,
  `img` varchar(255) NULL
);

*/

?>