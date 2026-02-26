<?php
/*
 *  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  · 
 *      1. CONEXIÓN CON LA BASE DE DATOS
 *  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  
 */

// valores de conexión con la Base de Datos (BBDD):
const SERV = "localhost"; // Servidor
const USER = "root";      // Nombre de Usuario
const PASS = "root";      // Contraseña
const DBNM = "local";     // Nombre de la base de datos

// Conectarse a la BBDD ó Crear Conexión:
$conn = new mysqli(SERV, USER, PASS, DBNM);

// Fuerza la codificación UTF-8 por si la base de datos no está en UTF-8
// esto evita que salgan caracteres raros como �
$conn->set_charset("utf8mb4");

// Comprobar Conexion
if ($conn->connect_error) {
  die("La conexión ha fallado: " . $conn->connect_error);
}




/*
 *  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  · 
 *      2. CONSULTA SQL
 *  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  
 */

// almacenamos la consulta en una variable:
$sql = "SELECT * FROM alumnos LIMIT 5";

// Ejecutamos la consulta y la almacenamos en $result
$result = $conn->query($sql);


/*
 *  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  · 
 *      3. MOSTRAMOS LOS RESULTADOS DE LA CONSULTA
 *  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  ·  
 */

// Si los resultados de la consulta dan un numero de filas mayor a 0 (si hay datos)
if ($result->num_rows > 0) {

  // Muestra cada dato de uno en uno (muestra cada fila)
  // Usando un bucle While:
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["apellidos"]. " " . $row["telefono"]."<br>";
  }
} 
    // si no, muestra el texto de que no hay resultados
else {
  echo "0 resultados";
}

// Cierra la conexión:
$conn->close();
?>
