<? require 'bloques/config.php'; ?>

<? //SI ESTAS LOGUEADO VES ESTE APARTADO, SI NO EXPULSO
_session_logueado();
if(!$logueado){
    header ("Location:expulsado.php");
}
?>

<? include 'bloques/header.php'; ?>
<div class='aviso'>Has accedido al panel de Administración</div>

<form action="admin.php" method="post" class="form-obras">
    <label for="obra">Nombre de la obra:</label>
    <input type="text" name="obra" id="obra" placeholder="Nombre de la obra" required> <br>

    <label for="autor">Autor:</label>
    <input type="text" name="autor" id="autor" placeholder="Autor" required><br>

    <label for="anio">Año:</label>
    <input type="text" name="anio" id="anio" placeholder="Año" required><br>

    <label for="estilo">Estilo:</label>
    <input type="text" name="estilo" id="estilo" placeholder="Estilo" required><br>

    <label for="tecnica">Técnica:</label>
    <input type="text" name="tecnica" id="tecnica" placeholder="Técnica" required><br>

    
    <label for="descripcion">Descripcion:</label>
    <textarea type="text" name="descripcion" id="descripcion" placeholder="Descripción y curiosidades" required></textarea>

    <label for="img">Imagen (URL o archivo):</label>
    <input type="text" name="img" id="img" placeholder="Imagen"><br>

    <input type="submit" value="Guardar Obra">
</form>

<?php
//cargamos el archivo JSON y lo traducimos a un array PHP
$archivo='assets/datos/museo.json';   //ruta del JSON

$museo = cargarJSON($archivo);     //llamada a la función de config.php donde carga el JSON y lo convierte en array que llamaremos $museo

debugPrint_r($museo);           // revisamos si $museo tiene datos


// recolectamos los datos del formulario
if(isset($_POST['obra'])){ // si existe obra en el GET
    $obra = $_POST['obra']; // guardamos en $obra lo que venga en el GET obra
    $autor = $_POST['autor']; // guardamos en $autor lo que venga en el GET autor
    $anio = $_POST['anio'];
    $estilo = $_POST['estilo'];
    $tecnica = $_POST['tecnica'];
    $descripcion = $_POST['descripcion'];
    $img = $_POST['img'];

    // agregamos la nueva obra al array museo
    $museo['obras'][] = array('titulo' => $obra, 'autor' => $autor, 'anio' => $anio, 'estilo' => $estilo, 'tecnica' => $tecnica, 'img' => $img, 'descripcion' => $descripcion);

    debugPrint_r($museo);           // revisamos si $museo tiene datos

    $museoJSON = json_encode($museo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    file_put_contents($archivo, $museoJSON);
    echo "Obra guardada correctamente";
    echo "<a href='index.php'>Volver al listado de obras</a>";

}

?>
<? require 'bloques/footer.php'; ?>