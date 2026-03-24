<? require 'functions.php'?>
<? getheader();?>

<a href="index.php" class="btn">❮❮ Volver</a>

<?php
$id = $_GET["id"];
    $sql = "SELECT * FROM obras WHERE id='$id'";
    $obra = consulta($sql);

    debug_print_r($obra, 'no indentado');
    
    $obra=$obra[0]; // abrir primera identación
    
    debug_print_r($obra,'tras abrir indentación');
?>

<?  ?>
<ul class="galeria">
            <h3><?=$obra['titulo']?></h3>
            <img src="<?=$obra['imagen']?>"/>
            <p><?=$obra['descripcion']?></p>
</ul>


<?getfooter();?>