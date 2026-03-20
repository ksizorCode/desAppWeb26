<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "academia";

try {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {      die("Connection failed: " . mysqli_connect_error());    }
    $sql = "SELECT * from alumnos";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        echo "<li>{$row["nombre"]}</li>";
      }    } 
      else {      echo "0 resultado";    }
    mysqli_close($conn);
  }   catch (Exception $e) {
    //echo $e->getMessage();
    header('Location: instalar.php');
    exit(); // Asegura que el script se detenga después de la redirección
  }








/*
// Activar el reporte de errores y excepciones de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Crear una nueva conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    // Redirigir a instalar.php en caso de error
    header('Location: instalar.php');
    exit(); // Asegura que el script se detenga después de la redirección
}
?>

*/

?>

entraste bien el abase de datos