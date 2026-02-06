
<?php
//    $nombre="Meganito";
//   $edad=201;
//felicitacion.php?nome=Celestino&edad=22&style=1
    $nombre= $_GET['nome'];
    $edad  = $_GET['edad'];
    $estilo =$_GET['style'];
?>

<title>Feliz <?=$edad?> cumpleaños <?= $nombre?></title>
<link rel="stylesheet" href="style<?= $estilo?>.css">

<h1>Feliz Cumpleaños <?= $nombre?></h1>
<h2>No todos los días se cumplen <?= $edad?></h2>
<p>Hola <?= $nombre ?>, queremos mandarte un abrazo y felicitarte por tu <?= $edad?> cumpleaños</p>




<a href="?nome=Cesar&edad=46&style=3">Cesar</a>
<a href="?nome=Jorge&edad=33&style=2">Jorge</a>
<a href="?nome=Sergio&edad=22&style=2">Sergio</a>
<a href="?nome=Nadine&edad=50&style=3">Nadine</a>
<a href="?nome=Himi&edad=28&style=1">Himi</a>
<a href="?nome=Lucas&edad=24">Lucas</a>
<a href="?nome=Elena&edad=31">Elena</a>
<a href="?nome=Mateo&edad=27">Mateo</a>
<a href="?nome=Sofía&edad=29">Sofía</a>
<a href="?nome=Diego&edad=35">Diego</a>
<a href="?nome=Valeria&edad=22">Valeria</a>
<a href="?nome=Bruno&edad=38">Bruno</a>
<a href="?nome=Carla&edad=26">Carla</a>
<a href="?nome=Iván&edad=33">Iván</a>
<a href="?nome=Marta&edad=30">Marta</a>