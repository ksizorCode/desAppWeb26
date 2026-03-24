<?php $t='admin'?>
<?php require 'bloques/_config.php'?>
<?php include_once 'bloques/_header.php';?>

<!-- FORMULARIO EN EL QUE RECOGEREMOS LOS DATOS DE LA CERVEZA -->
<form action="admin.php" method="get">
    <label>Nombre:<input type="text" name="nombre" required></label>
    <label>Tipo:<input type="text" name="tipo"></label>
    <label>Origen:<input type="text" name="origen"></label>
    <label>Alcohol:<input step="0.01" type="number" name="alcohol"></label>
    <label>Precio:<input step="0.01" type="number" name="precio"></label>
    <input type="submit" value="Guardar cerveza">
</form>
<?php 
    //Cargar datos que recogemos de los inputs($_GET)
    // $nombre = $_GET['nombre']; // contenido sin revisar , se podría meter codigo malicioso
   // $nombre =strip_tags($_GET['nombre']); //evita inyección de código 

   $nombre = $_GET['nombre'];
   $tipo = $_GET['tipo'];
   $origen = $_GET['origen'];
   $alcohol = $_GET['alcohol'];
   $precio = $_GET['precio'];

    if($nombre !== strip_tags($nombre)){
        $nombre =  htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); // convierto el contenido a un string seguro
        echo "<h2>No puede insertarte framento de código</h2>";
        echo "<p>Así que lo hemos sanitizado. Ahora es: $nombre</p>";
    }

//    echo "<div class='info'><span>Hemos guardado el valor:</span>$nombre <p> <a href='index.php'>Volver a Inicio</a></div>";

    //Cargar datos del JSON y convertirlo en un Array PHP
    $miArray = cargarJSON('assets/datos/cervezas.json');

    //Añadir al Array PHP los datos recogidos
    $id=time();
    $miArray['cervezas'][] = array('id'=>$id,'nombre'=>$nombre, 'tipo'=>$tipo, 'origen'=>$origen, 'alcohol'=>$alcohol, 'precio'=>$precio);
    debugPrint_r($miArray);

    //Codificar el Array PHP a JSON
    $miJSON = json_encode($miArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    //Guardar JSON
    file_put_contents('assets/datos/cervezas.json', $miJSON);

?>
<?php include_once 'bloques/_footer.php';?>