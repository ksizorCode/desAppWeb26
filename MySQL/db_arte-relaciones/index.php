<? require 'functions.php'?>
<? getheader();?>

<h1>Bienvenidos a <?= TITLE?></h1>
<p>Aquí encontrarás una lista de obras de caracter multidisciplinar relacionadas con artista y su ámbito</p>


<? debug_print_r("El Modo debug está activado.", "AVISO");?>

<?php
    $sql = "SELECT * FROM obras";
    $obras = consulta($sql);
?>

<? debug_print_r($obras); ?>

<ul class="galeria">
    <? foreach($obras as $obra):?>
        <li>
        <a href="info.php?id=<?=$obra['id']?>">
            <h3><?=$obra['titulo']?></h3>
            <img src="<?=$obra['imagen']?>"/>
            <p><?=$obra['descripcion']?></p>
        </a>
        </li>
<? endforeach;?>
</ul>









<?getfooter();?>