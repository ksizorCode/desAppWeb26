<?php 
require_once 'functions.php'; 

// 1. Traemos todo con el asterisco
$alumnos = obtener_datos("SELECT * FROM alumnos");

me_header(); 
?>

<h1>Fichas Detalladas de Alumnos</h1>
<ul class="lista">


<?php
// 2. Llamamos a la nueva función
foreach($alumnos as $alumno):?>
    <li>
        <a href="ficha.php?id=<?=$alumno['id']?>">   
            <? echo $alumno['id']?>
            <img src="assets/img/<? echo $alumno['foto']?>" alt="<?=$alumno['nombre'].' '.$alumno['apellido']?>"> 
        <?=$alumno['nombre'].' '.$alumno['apellido']?>
        </a>
    </li>
<?endforeach;?>
</ul>

<?php me_footer(); ?>






<?
// Versión 2 Facilita:


// Crear conexión
$conn = new mysqli(SERV, USER, PASS, DBNM);
$conn -> set_charset("utf8mb4");
// Check connection
if ($conn->connect_error) {  die("Connection failed: " . $conn->connect_error);}

// Almacenar consulta en una variable
$sql = "SELECT * FROM alumnos";
// Ejecutar la consulta
$result = $conn->query($sql);

//Array donde almacenaremos los nuevos datos (alumnos)
$datos=[];

// Convertir datos en array
if ($result->num_rows > 0) {
  // Recorre en un bucle tantas iteraciones como existan en la tabla
  while($row = $result->fetch_assoc()) {
      $datos[] = $row;
  }
} else {
  echo "<p>No hay alumno</p>";
}

$conn->close();



echo '<pre>';
print_r($datos);
echo '---- /// ---- /// ----';
var_dump($datos);
echo '</pre>';







foreach($datos as $alumno){
    echo "<li>{$alumno['nombre']}</li>";
}


?>



