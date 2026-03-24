<? require '_config.php'?>
<? cargarCabecera()?>
<?php

if(isset($_GET['especie'])){
    $especie = $_GET['especie'];
}


$sql = "SELECT * FROM animales, especies WHERE animales.id_especie = especies.id_especie AND animales.id_especie = $especie";
$result =consulta($sql,true);


if (mysqli_num_rows($result) > 0) {
  // output data of each row
  echo '<table>';
  while($i = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo  '<td>'.$i["id_animal"].'</td>';
    echo  '<td>'.$i["nombre_animal"].'</td>';
    echo  '<td>'.$i["foto_animal"].'</td>';
    echo  '<td>'.$i["descripcion"].'</td>';
    echo  '<td>'.$i["nombre_especie"].'</td>';
    echo  '<td><a href="info.php?id='.$i["id_animal"].'">Ver más</a></td>';

    echo '</tr>';
    }


} else {
    echo "0 resultados";
}
echo '</table>';

?>




<? cargarPie()?>