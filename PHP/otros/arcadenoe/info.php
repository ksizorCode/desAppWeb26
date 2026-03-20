<? require '_config.php'?>

<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

 $sql = "SELECT animales.*, especies.nombre_especie, especies.icono FROM animales, especies WHERE animales.id_animal=$id AND animales.id_especie = especies.id_especie";
 $result =consulta($sql,true);
 if (mysqli_num_rows($result) > 0) {
    // output data of each row
  
 while($i = mysqli_fetch_assoc($result)) {
    $titulo= $i['nombre_animal'];
    $foto_animal= $i['foto_animal'];
    $descripcion= $i['descripcion'];
    $id_especie= $i['id_especie'];
    $icono= $i['icono'];
    $nombre_especie= $i['nombre_especie'];
 }
} 

?>


<? cargarCabecera()?>



<div class="ficha-animal">
<?php

    echo  '<h1>'.$titulo.'</h1>';
    echo  '<img src="'.RUTA_IMG.$foto_animal.'" alt="'.$titulo.'">';
    echo  '<p>'.$descripcion.'</p>';
    echo  '<a href="especie.php?especie='.$id_especie.'">';
    echo '<img src="'.RUTA_IMG.'iconos/'.$icono.'">'.$nombre_especie.'</a>';

?>

</div>

<? cargarPie()?>