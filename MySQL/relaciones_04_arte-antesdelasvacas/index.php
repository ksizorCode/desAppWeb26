<?
//cargamos las funciones
require_once '_funciones.php';

// Objtenemos el id de la obra
$id_obra=1;

if(isset($_GET['id'])){
    $id_obra =$_GET['id'];
}

// consulta 01 - mostrar todos los datos de la obra
$sql = file_get_contents('obras_consulta.sql');
$sql .= 'WHERE obras.id = '.$id_obra;
$obra = consulta($sql);
$obra = $obra[0]; // matriz -> vector


// obtener id del autor a partir de la consulta anterior
$id_autor=$obra['id_autor'];



// consulta 03 - mostrar obras del mismo autor
$sql="SELECT 
obras.id,
obras.titulo,
obras.imagen,
autores.nombre,
autores.id AS id_autor
FROM obras
JOIN obras_autores ON obras.id = obras_autores.obra_id
JOIN autores       ON autores.id = obras_autores.autor_id
WHERE autores.id=$id_autor;";
$autores = consulta($sql);

// Mostrar contenido
?>

<h2>Obra: <?= $obra['titulo']?></h2>
<pre>
    <code>
        <?print_r($obra)?>
    </code>
</pre>


<h3>Otras obras del mismo autor: <?= $obra['autor']?></h3>
<pre>
    <code>
        <?print_r($autores)?>
    </code>
</pre>








?>