<? require '_config.php'?>
<? $titulo ="Bienvenidos a nuestar lista de animales"?>

<? cargarCabecera()?>
<h1><?titulo()?></h1>

<?php if($admin){?>
    <button href="add.php">Añadir nuevo animal</button>
<?php }?>
<?php


$sql = "SELECT id_animal, nombre_animal, foto_animal, descripcion, nombre_especie FROM animales, especies WHERE animales.id_especie = especies.id_especie ORDER BY nombre_animal ASC";
$result =consulta($sql,true);


if (mysqli_num_rows($result) > 0) {
  // output data of each row
  echo '<table>';
  echo '<thead>';
  echo '<tr>';
  echo '<th>ID</th> <th>Nombre</th> <th>Foto</th> <th>URL img</th> <th>Descripcion</th> <th>Especie</th>';
  echo '<tr>';
  echo '</thead>';
  while($i = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo  '<td>'.$i["id_animal"].'</td>';
    echo  '<td>'.$i["nombre_animal"].'</td>';
    echo  '<td><img src="'.RUTA_IMG.$i["foto_animal"].'"></td>';
    echo  '<td>'.$i["foto_animal"].'</td>';
    echo  '<td>'.$i["descripcion"].'</td>';
    echo  '<td>'.$i["nombre_especie"].'</td>';
    echo  '<td><a href="info.php?id='.$i["id_animal"].'">Ver más</a></td>';
    if($admin){
        echo  '<td><a href="editar.php?id='.$i["id_animal"].'">Editar</a></td>';
        echo  '<td><a href="borrar.php?id='.$i["id_animal"].'">Borrar</a></td>';
    }
    echo '</tr>';
    }


} else {
    echo "0 resultados";
}
echo '</table>';

?>

<?php if($admin){?>
    <button href="add.php">Añadir nuevo animal</button>
<?php }?>




<? cargarPie()?>