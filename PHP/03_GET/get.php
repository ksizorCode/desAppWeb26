<? 
//$dato ='C-3PO';
//www.miweb.com/archivo.php?nombre=Pepito
$dato = $_GET['nombre'];  ?>

<title>La web de <? echo $dato?></title>

<h1><? echo $dato?></h1>
<h2>Hola, bienvenido <?= $dato?></h2>
<p>Estanos encantados de tenerte aquí <? echo $dato?></p>

<footer>
    <p>&copy; <?= $dato?></p>
</footer>